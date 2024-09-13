<?php

namespace App\Repositories;

use App\Helpers\TokenHelper;
use App\Mail\SendOtp;
use App\Models\OtpCode;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class WalletRepository
{
    public function store($request): JsonResponse
    {
        try {
            $data = $request->all();

            $encryptedData = $this->encryptCredentials($data);

            $request->merge([
                'credentials' => $encryptedData
            ]);
            Wallet::create($request->except(['name', 'email', 'tel_no']));

            return response()->json('Wallet successfully created.');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json('Wallet create failed.', 400);
        }

    }
    public function update($request): JsonResponse
    {
        try {
            $data = $request->all();
            $wallet = Wallet::find($request->wallet_id);

            $encryptedData = $this->encryptCredentials($data);
            $request->merge([
                'credentials' => $encryptedData
            ]);
            $wallet->update($request->except(['wallet_id']));

            return response()->json('Wallet successfully updated.');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json('Wallet update failed.', 400);
        }

    }

    public function encryptCredentials($data): string
    {
        $jsonArray = [];

        foreach ($data as $key => $value) {
            if (preg_match('/^(url|username|password)-(\d+)$/', $key, $matches)) {
                $type = $matches[1];
                $index = $matches[2];

                if (!isset($jsonArray[$index])) {
                    $jsonArray[$index] = [];
                }

                $jsonArray[$index][$type] = $value;
            }
        }

        $jsonArray = array_values($jsonArray);
        $jsonOutput = json_encode($jsonArray);
        return Crypt::encryptString($jsonOutput);
    }

    public function getSecureWallets(): View
    {
        $user = Auth::user();
        $wallets = ($user->hasRole('admin')) ? Wallet::get() : Wallet::where('user_id', $user->id)->get();
        return view('pages/wallets-list', ['wallets' => $wallets]);
    }

    public function getSingleWallet($id): View
    {
        $wallet = Wallet::find($id);
        $credentials = Crypt::decryptString($wallet->credentials);
        $credArray = json_decode($credentials);

        $tokenData = [
            'type' => 'secure_wallet',
            'id' => $wallet->id,
            'view_file' => 'pages/wallets'
        ];

        $token = TokenHelper::createToken($tokenData);
        return view('pages/wallets', ['wallet' => $wallet, 'credentials' => $credArray, 'copy_link' => url('/').'/view-secure-wallet/'.$token]);
    }

    public function updateWalletStatus($request): JsonResponse
    {
        $wallet = Wallet::find($request->card_id);
        $status = $request->status === 'true';
        $wallet->update(['status' => $status]);
        return response()->json('wallet status successfully updated.');
    }

    public function viewSecureWalletOnGuest($token)
    {
        try{
            $tokenData = TokenHelper::readToken($token);
            $wallet = Wallet::find($tokenData['id']);
            if (!$wallet->status || $wallet->user->userDetail->status != 'true') {
                return view('pages/temporary-disable');
            }
            $credentials = Crypt::decryptString($wallet->credentials);
            $credArray = json_decode($credentials);
            $avatar = ($wallet->user->avatar) ?: null;
            $address = ($wallet->user->userDetail) ? $wallet->user->userDetail->address : null;
            $name = $wallet->user->name;
            $createdDate = Carbon::parse($wallet->created_at)->format('M Y');
            session()->put('wallet_redirect_url', url('/').'/view-secure-wallet/'.$token);
            if (session()->has('wallet_otp_verified') ||( Auth::user() && Auth::user()->id === $wallet->user->id) || (Auth::user() && Auth::user()->hasRole('admin'))) {
                session()->remove('wallet_otp_verified');
                session()->remove('wallet_redirect_url');
                session()->remove('otp_verify_user_id');
                session()->remove('otp_sent');
                session()->remove('otp_verify_user_email');
                return view('pages/wallets', [
                    'wallet' => $wallet,
                    'credentials' => $credArray,
                    'avatar' => $avatar,
                    'address' => $address,
                    'name' => $name,
                    'createdDate' => $createdDate
                ]);
            } else {
                if(!session()->has('otp_sent')) {
                    $this->generateOtp($wallet->user);
                }
                session()->put('otp_verify_user_id', $wallet->user->id);
                session()->put('otp_verify_user_email', $wallet->user->email);
                return view('auth/confirm-otp');
            }
        } catch (\Exception $e) {
            Log::error($e);
            abort(500, 'Something is not right. Please try again');
        }
    }

    public function generateOtp($user)
    {
        $otp = rand(100000, 999999);
        $otpCode = OtpCode::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(2)
            ]
        );
        session()->put('otp_sent', true);
        Mail::to($user->email)->send(new SendOtp($otpCode));
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function verifyOtp($request): JsonResponse|RedirectResponse
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);
        $validOtp = OtpCode::where('otp', $request->otp)->first();

        Log::info($validOtp);
        if($validOtp && $validOtp->user_id === session()->get('otp_verify_user_id')){
            if (Carbon::now()->greaterThan($validOtp->otp_expires_at)) {
                return response()->json(['message' => 'OTP has expired. Please request a new OTP Code.', 'errors' => ['otp' => ['OTP has expired. Please request a new OTP Code.']]], 422);
            }
            if ((int)$request->otp === $validOtp->otp) {
                session()->put('wallet_otp_verified', true);
                return response()->json(['message' => 'OTP Validated', 'url' => session()->get('wallet_redirect_url')]);
            } else {
                Log::info('Error 1 | Request otp: '.$request->otp.' DB otp: '.$validOtp->otp);
                return response()->json(['message' => 'invalid otp code', 'errors' => ['otp' => ['invalid otp code']]], 422);
            }
        } else {
            Log::info('Error 2');
            return response()->json(['message' => 'invalid otp code', 'errors' => ['otp' => ['invalid otp code']]], 422);
        }
    }

    public function resendOtp(): JsonResponse
    {
        $userId = session()->get('otp_verify_user_id');
        $user = User::find($userId);
        if($user) {
            if($user->otp_code && Carbon::now()->greaterThan($user->otp_code->otp_expires_at)) {
                $this->generateOtp($user);
                return response()->json(['message' => 'OTP sent to your email. Please check and try.']);
            } else {
                return response()->json(['message' => 'Invalid request. Please wait 2 minutes after the initial OTP request to request again.', 'errors' => ['otp' => ['Invalid request. Please wait 2 minutes after the initial OTP request to request again.']]], 422);
            }
        }
        return response()->json(['message' => 'invalid request', 'errors' => ['otp' => ['invalid otp code']]], 422);
    }
}
