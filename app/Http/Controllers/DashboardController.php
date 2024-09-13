<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use App\Models\CustomCard;
use App\Models\PetTag;
use App\Models\StorageTag;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBusinessCards = (Auth::user()->hasRole('admin')) ? BusinessCard::get()->count() : BusinessCard::where('user_id', Auth::user()->id)->get()->count();
        $totalSecureWallets = (Auth::user()->hasRole('admin')) ? Wallet::get()->count() : Wallet::where('user_id', Auth::user()->id)->get()->count();
        $totalCustomCards = (Auth::user()->hasRole('admin')) ? CustomCard::get()->count() : CustomCard::where('user_id', Auth::user()->id)->get()->count();
        $totalPetTags = (Auth::user()->hasRole('admin')) ? PetTag::get()->count() : PetTag::where('user_id', Auth::user()->id)->get()->count();
        $totalStorageTags = (Auth::user()->hasRole('admin')) ? StorageTag::get()->count() : StorageTag::where('user_id', Auth::user()->id)->get()->count();
        return view('pages/dashboard', [
            'totalBusinessCards' => $totalBusinessCards,
            'totalSecureWallets' => $totalSecureWallets,
            'totalCustomCards' => $totalCustomCards,
            'totalPetTags' => $totalPetTags,
            'totalStorageTags' => $totalStorageTags
        ]);
    }
}
