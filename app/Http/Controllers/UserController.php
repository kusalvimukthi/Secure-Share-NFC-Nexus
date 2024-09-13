<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SetNewPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected UserRepository $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('create_customers')) {
            return $this->user->createCustomer($request);
        }
        return User::abort(403);
    }

    public function update(UpdateUserRequest $request): JsonResponse|RedirectResponse
    {
        if (Auth::user()->hasAnyPermission(['view_cards', 'create_customers'])) {
            return $this->user->updateCustomer($request);
        }
        return User::abort(403);
    }

    public function getUserTableData(): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('create_customers')) {
            return $this->user->getUserTableData();
        }
        return User::abort(403);
    }

    public function getCustomersPage():View
    {
        if (Auth::user()->hasPermissionTo('create_customers')) {
            return view('pages/customers');
        }
        return User::abort(403);
    }

    public function getUsersPage():View
    {
        if (Auth::user()->hasPermissionTo('create_customers')) {
            $activeUserCount = User::whereHas('userDetail', function ($query) {
                $query->where('status', 'true');
            })->get()->count();
            $inactiveUserCount = User::whereHas('userDetail', function ($query) {
                $query->where('status', 'false');
            })->get()->count();
            $totalUsers = User::get()->count();
            return view('pages/user', ['allUsers' => $totalUsers, 'activeUsersCount' => $activeUserCount, 'inactiveUserCount' => $inactiveUserCount]);
        }
        return User::abort(403);
    }

    public function getCustomersTableData(): JsonResponse
    {
        if (Auth::user()->hasAnyPermission(['view_cards', 'create_customers'])) {
            return $this->user->getCustomersTableData();
        }
        return User::abort(403);
    }

    public function verifyLogin($token): RedirectResponse
    {
        return $this->user->verifyLogin($token);
    }

    public function verifyEmail($token): RedirectResponse
    {
        return $this->user->verifyEmail($token);
    }

    public function getSetPasswordView(): RedirectResponse|View
    {
        if(Auth::user()){
            return redirect()->route('dashboard');
        }
        return view('auth/set-password');
    }

    public function setNewPassword(SetNewPasswordRequest $request): JsonResponse
    {
        return $this->user->setNewPassword($request);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        return $this->user->changePassword($request);
    }

    public function resendVerification(): void
    {
        $this->user->resendVerification();
    }

    public function getCustomer($id)
    {
        return $this->user->getCustomer($id);
    }

    public function getProfilePage($id):View
    {
        return $this->user->getProfilePage($id);
    }


    public function getCombinedCards($id)
    {
        return $this->user->getCombinedCards($id);
    }
}
