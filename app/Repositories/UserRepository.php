<?php

namespace App\Repositories;

use App\Mail\EmailChanged;
use App\Mail\UserCreated;
use App\Models\BusinessCard;
use App\Models\CustomCard;
use App\Models\PetTag;
use App\Models\StorageTag;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Wallet;

use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class UserRepository
{
    public function createCustomer($request): JsonResponse
    {
        try {
            $request->merge(['password' => Str::random(8)]);
            $user = User::create($request->only(['name', 'email', 'password']));
            $request->merge(['user_id' => $user->id]);
            UserDetail::create($request->only(['user_id', 'tel_no', 'nic', 'address', 'town', 'state', 'post_code', 'status']));

            if($request->user_type === 1){
                $user->assignRole('admin');
            } else if ($request->user_type === 2) {
                $user->assignRole('supervisor');
            } else {
                $user->assignRole('customer');
            }
            $data = [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name
            ];

            $encryptedToken = Crypt::encryptString(json_encode($data));
            $user->token = $encryptedToken;
            Mail::to($request->email)->send(new UserCreated($user));

            return response()->json(['Customer successfully created.']);
        } catch (Exception $e) {
            Log::info($e);
            return response()->json(['Customer creation failed.'], 400);
        }
    }

    public function updateCustomer($request): JsonResponse|RedirectResponse
    {
        Log::info('TEST');
        try {
            $userId = ($request->has('user_id')) ? $request->user_id : Auth::user()->id;
            $user = User::find($userId);
            $currentEmail = $user->email;
            $url = null;

            $updateData = [
                'name' => $request->name,
                'email' => $request->email
            ];

            if ($request->hasFile('avatar')) {
                Log::info('File received');
                $file = $request->file('avatar');

                if ($file->isValid()) {
                    $path = $file->store('avatars', 'public');
                    $url = Storage::url($path);
                    $updateData['avatar'] = $url;
                } else {
                    Log::warning('Invalid file:', ['file' => $file]);
                }

            }

            $user->update($updateData);

            UserDetail::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'tel_no' => $request->tel_no,
                    'address' => $request->address,
                    'town' => $request->town,
                    'state' => $request->state,
                    'post_code' => $request->post_code,
                    'nic' => ($request->has('nic')) ? $request->nic : 'NA',
                    'status' => ($request->has('status')) ? $request->status : 1
                ]
            );

            if ($currentEmail != $request->email) {

                $user->update([
                    'email_verified_at' => null
                ]);

                $data = [
                    'user_id' => $user->id,
                    'email' => $user->email
                ];

                $encryptedToken = Crypt::encryptString(json_encode($data));
                $user->token = $encryptedToken;
                Auth::logout();
                Mail::to($request->email)->send(new EmailChanged($user));
                return response()->json(['message' => 'User successfully updated', 'redirect_url' => url('/').'/verify-email']);

            }

            return response()->json(['message' => 'User successfully updated', 'redirect_url' => url('/').'/accountsettings']);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['User update failed'], 400);
        }
    }

    public function getUserTableData(): JsonResponse
    {
        $data = User::with('userDetail')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tel_no', function ($row){
                Log::info($row);
                return ($row->userDetail) ? $row->userDetail->tel_no : 'NA';
            })
            ->addColumn('address', function ($row){
                return ($row->userDetail) ? $row->userDetail->address : 'NA';
            })
            ->editColumn('status', function ($row) {
                if ($row->userDetail) {
                    // Check the status value and return the corresponding HTML
                    if ($row->userDetail->status === 'true') {
                        return '<span class="badge bg-label-success">active</span>';
                    } else {
                        return '<span class="badge bg-label-danger">inactive</span>';
                    }
                }
                return 'NA'; // If no userDetail is available
            })
            ->addColumn('user_type', function ($row){
                return $row->getRoleNames()->first();
            })
            ->addColumn('nic', function ($row){
                return ($row->userDetail) ? $row->userDetail->nic : 'NA';
            })
            ->addColumn('action', function ($row){
                return '<a href="/user/'.$row->id.'" class="btn btn-icon item-edit"><i class="bx bx-show bx-md"></i></a><a href="" id="openUserEdit"><i class="bx bx-edit bx-md"></i></a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function getCustomersTableData(): JsonResponse
    {
        $data = User::role('customer')->with('userDetail')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tel_no', function ($row){
                Log::info($row);
                return ($row->userDetail) ? $row->userDetail->tel_no : 'NA';
            })
            ->editColumn('status', function ($row) {
                if ($row->userDetail) {
                    // Check the status value and return the corresponding HTML
                    if ($row->userDetail->status === 'true') {
                        return '<span class="badge bg-label-success">active</span>';
                    } else {
                        return '<span class="badge bg-label-danger">inactive</span>';
                    }
                }
                return 'NA'; // If no userDetail is available
            })
            ->addColumn('nic', function ($row){
                return ($row->userDetail) ? $row->userDetail->nic : 'NA';
            })
            ->addColumn('action', function ($row){
                return '<a href="/user/'.$row->id.'" class="btn btn-icon item-edit"><i class="bx bx-show bx-md"></i></a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function verifyLogin($token): RedirectResponse
    {
        $decryptedToken = Crypt::decryptString($token);
        $data = json_decode($decryptedToken);
        $user = User::find($data->user_id);
        Session::put('verify_email', $data->email);
        Session::put('verify_email_user', $data->user_id);
        Session::put('verify_user_name', $data->name);
        if ($user->email_verified_at) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('user.setPassword');
        }
    }

    public function verifyEmail($token): RedirectResponse
    {
        $decryptedToken = Crypt::decryptString($token);
        $data = json_decode($decryptedToken);
        $user = User::find($data->user_id);
        if ($user->email === $data->email) {
            $user->update([
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return abort(403, 'Invalid user');
    }

    public function setNewPassword($request): JsonResponse
    {
        try {
            $userId = Session::get('verify_email_user');
            $user = User::find($userId);
            $user->update([
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => $request->password
            ]);
            Auth::login($user);
            Session::remove('verify_email');
            Session::remove('verify_email_user');
            return response()->json(['status'=> true, 'url' => url('/dashboard')]);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['status'=> false], 400);
        }

    }

    public function changePassword($request): JsonResponse
    {
        try {
            $user = Auth::user();

            if (!Hash::check($request->input('current_password'), $user->password)) {
                return response()->json(['errors' => ['current_password' => ['The current password is incorrect.']]], 422);
            }

            $user->update([
                'password' => $request->password
            ]);
            Auth::login($user);
            return response()->json(['status'=> true, 'message' => 'Password successfully updated']);
        } catch (Exception $e) {
            Log::error($e);
            return response()->json(['status'=> false], 400);
        }

    }

    public function resendVerification(): void
    {
        $userId = Session::get('auth_user_id');
        $user = User::find($userId);
        $data = [
            'user_id' => $user->id,
            'email' => $user->email
        ];

        $encryptedToken = Crypt::encryptString(json_encode($data));
        $user->token = $encryptedToken;
        Mail::to($user->email)->send(new EmailChanged($user));
    }

    public function getCustomer($id)
    {
        $user = User::with('userDetail')->find($id);
        if ($user) {
            if ($user->hasRole('admin')) {
                $type = 1;
            } elseif ($user->hasRole('supervisor')) {
                $type = 2;
            } else {
                $type = 3;
            }
            $user['type'] = $type;
            return $user;
        }
        return response()->json('User not found', 400);
    }

    public function getProfilePage($id)
    {
        $user = User::find($id);
        return view('pages/profile-user', ['user' => $user]);
    }

    public function getCombinedCards($id)
    {
        $businessCards = BusinessCard::where('user_id', $id)->get();
        $walletCards = Wallet::where('user_id', $id)->get();
        $customCards = CustomCard::where('user_id', $id)->get();
        $petCards = PetTag::where('user_id', $id)->get();
        $storageCards = StorageTag::where('user_id', $id)->get();
        $combinedData = collect();

        $combinedData = $combinedData->merge($businessCards->map(function ($item) {
            $item->type = 'Business Card';
            return $item;
        }));
        $combinedData = $combinedData->merge($walletCards->map(function ($item) {
            $item->type = 'Wallet';
            return $item;
        }));
        $combinedData = $combinedData->merge($customCards->map(function ($item) {
            $item->type = 'Custom Card';
            return $item;
        }));
        $combinedData = $combinedData->merge($petCards->map(function ($item) {
            $item->type = 'Pet Card';
            return $item;
        }));
        $combinedData = $combinedData->merge($storageCards->map(function ($item) {
            $item->type = 'Storage Card';
            return $item;
        }));


        return Datatables::of($combinedData)
            ->addIndexColumn()
            ->addColumn('card_type', function ($row) {
                return $row->type;
            })
            ->editColumn('name', function ($row) {
                if ($row->type === 'Business Card' || $row->type === 'Pet Card' || $row->type === 'Storage Card') {
                    $avatar = $row->avatar;
                } elseif ($row->type === 'Wallet' || $row->type === 'Custom Card') {
                    $avatar = $row->user->avatar ?? '/assets/master_ui/img/avatars/1.png';
                } else {
                    $avatar = '/assets/master_ui/img/avatars/1.png';
                }
                $name = $row->name ?? $row->user->name ?? 'N/A';
                return '
                    <div class="d-flex justify-content-left align-items-center">
                        <div class="avatar-wrapper">
                            <div class="avatar avatar-sm me-3">
                                <img src="' . $avatar . '" alt="Avatar" class="rounded-circle">
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-50">
                            <span class="text-truncate fw-medium text-heading">' . $name . '</span>
                            <small class="text-truncate">' . $row->created_at->format('d M Y') . '</small>
                        </div>
                    </div>
                ';
            })
            ->editColumn('email', function ($row) {
                return $row->email ?? ($row->user->email ?? 'N/A');
            })
            ->editColumn('status', function ($row) {
                return $row->status == 1
                    ? '<span class="badge bg-label-success w-100">active</span>'
                    : '<span class="badge bg-label-danger w-100">inactive</span>';
            })
            ->addColumn('action', function ($row) {
                switch ($row->type) {
                    case 'Business Card':
                        $url = "/business-card/{$row->id}";
                        break;
                    case 'Wallet':
                        $url = "/wallet/{$row->id}";
                        break;
                    case 'Custom Card':
                        $url = "/custom-card/{$row->id}";
                        break;
                    case 'Pet Card':
                        $url = "/pet-tag/{$row->id}";
                        break;
                    case 'Storage Card':
                        $url = "/storage-tag/{$row->id}";
                        break;
                    default:
                        $url = '#';
                        break;
                }
                return '<a href="' . $url . '" class="btn btn-icon item-edit"><i class="bx bx-show bx-md"></i></a>';
            })
            ->rawColumns(['name', 'status', 'action'])
            ->make(true);
    }

}
