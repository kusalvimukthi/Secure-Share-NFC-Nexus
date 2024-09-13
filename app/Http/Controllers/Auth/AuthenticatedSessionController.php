<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\BusinessCard;
use App\Models\CustomCard;
use App\Models\PetTag;
use App\Models\StorageTag;
use App\Models\Wallet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $totalBusinessCards = (Auth::user()->hasRole('admin')) ? BusinessCard::get()->count() : BusinessCard::where('user_id', Auth::user()->id)->get()->count();
        $totalSecureWallets = (Auth::user()->hasRole('admin')) ? Wallet::get()->count() : Wallet::where('user_id', Auth::user()->id)->get()->count();
        $totalCustomCards = (Auth::user()->hasRole('admin')) ? CustomCard::get()->count() : CustomCard::where('user_id', Auth::user()->id)->get()->count();
        $totalPetTags = (Auth::user()->hasRole('admin')) ? PetTag::get()->count() : PetTag::where('user_id', Auth::user()->id)->get()->count();
        $totalStorageTags = (Auth::user()->hasRole('admin')) ? StorageTag::get()->count() : StorageTag::where('user_id', Auth::user()->id)->get()->count();
        return redirect()->intended(route('dashboard', absolute: false))->with([
            'totalBusinessCards' => $totalBusinessCards,
            'totalSecureWallets' => $totalSecureWallets,
            'totalCustomCards' => $totalCustomCards,
            'totalPetTags' => $totalPetTags,
            'totalStorageTags' => $totalStorageTags,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(route('login', absolute: false));
    }
}
