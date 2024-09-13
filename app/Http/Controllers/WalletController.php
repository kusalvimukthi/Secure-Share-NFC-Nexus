<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Http\Requests\WalletStatusUpdateRequest;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class WalletController extends Controller
{
    protected WalletRepository $wallet;

    public function __construct(WalletRepository $wallet)
    {
        $this->wallet = $wallet;
    }

    public function getWalletCreatePage(): View
    {
        if (Auth::user()->hasPermissionTo('create_wallets')) {
            $customers = User::role('customer')->get();
            return view('pages/wallets-create', ['customers' => $customers]);
        }
        return User::abort(403);
    }

    public function getWalletUpdatePage($id): View
    {
        if (Auth::user()->hasPermissionTo('update_wallets')) {
            $wallet = Wallet::find($id);
            $credentials = Crypt::decryptString($wallet->credentials);
            return view('pages/wallets-update', ['wallet' => $wallet, 'credentials' => json_decode($credentials)]);
        }
        return User::abort(403);
    }

    public function store(CreateWalletRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('create_wallets')) {
            return $this->wallet->store($request);
        }
        return User::abort(403);
    }

    public function update(UpdateWalletRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('update_wallets')) {
            return $this->wallet->update($request);
        }
        return User::abort(403);
    }

    public function getSecureWallets(): View
    {
        return $this->wallet->getSecureWallets();
    }

    public function getSingleWallet($id): View
    {
        return $this->wallet->getSingleWallet($id);
    }

    public function updateWalletStatus(WalletStatusUpdateRequest $request): JsonResponse
    {
        return $this->wallet->updateWalletStatus($request);
    }

    public function viewSecureWalletOnGuest($token)
    {
        return $this->wallet->viewSecureWalletOnGuest($token);
    }

    public function verifyOtp(Request $request): JsonResponse|RedirectResponse
    {
        return $this->wallet->verifyOtp($request);
    }

    public function resendOtp(): JsonResponse
    {
        return $this->wallet->resendOtp();
    }
}
