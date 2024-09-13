<?php

use App\Http\Controllers\BusinessCardController;
use App\Http\Controllers\CustomCardsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StorageTagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Middleware\CheckEmailVerified;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

//Route::get('/test', function () {
//    $user = \App\Models\User::find(20);
//    Mail::to('test@gmail.com')->send(new UserCreated($user));
//});

Route::middleware(['auth', CheckEmailVerified::class])->group(function () {
    Route::get('/', function () {
        return view('pages/dashboard');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
     * Customer and user details
     */
    Route::post('/create_customer', [UserController::class, 'store'])->name('user.create');
    Route::post('/update_user', [UserController::class, 'update'])->name('user.update');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::get('/accountsettings', function () {
        return view('pages/account-settings');
    });
    Route::get('user/{id}', [UserController::class, 'getProfilePage']);
//    Route::get('/profileuser', function () {
//        return view('pages/profile-user');
//    });
    Route::get('/accountsecurity', function () {
        return view('pages/account-settings-security');
    });
    Route::get('customer/{id}', [UserController::class, 'getCustomer']);

    /*
     * Dashboard
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
     * Users table view
     */
    Route::get('/users', [UserController::class, 'getUsersPage'])->name('users');
    Route::get('users-data', [UserController::class, 'getUserTableData'])->name('users.data');
    Route::get('/combined-card-list/{id}', [UserController::class, 'getCombinedCards'])->name('users.combined_card_data');

    /*
     * Customers table view
     */
    Route::get('/customers', [UserController::class, 'getCustomersPage']);
    Route::get('customers-data', [UserController::class, 'getCustomersTableData'])->name('users.data');

    /*
     * Business cards
     */
    Route::get('/business-card-create', [BusinessCardController::class, 'getBusinessCardCreatePage']);
    Route::post('/business-card-create', [BusinessCardController::class, 'store']);
    Route::get('/cards-view', [BusinessCardController::class, 'getBusinessCards']);
    Route::get('/business-card/{id}', [BusinessCardController::class, 'getSingleBusinessCard']);
    Route::get('/business-card-update/{id}', [BusinessCardController::class, 'getBusinessCardUpdatePage']);
    Route::post('/business-card-update', [BusinessCardController::class, 'update']);
    Route::post('/business-card-disable', [BusinessCardController::class, 'updateBusinessCardStatus']);

    /*
     * Wallet
     */
    Route::get('/create-wallet', [WalletController::class, 'getWalletCreatePage']);
    Route::post('/wallet-create', [WalletController::class, 'store']);
    Route::get('/wallets-list', [WalletController::class, 'getSecureWallets']);
    Route::get('/wallet/{id}', [WalletController::class, 'getSingleWallet']);
    Route::get('/wallet-update/{id}', [WalletController::class, 'getWalletUpdatePage']);
    Route::post('/wallet-update', [WalletController::class, 'update']);
    Route::post('/wallet-disable', [WalletController::class, 'updateWalletStatus']);

    /*
     * Custom Card
     */
    Route::get('/create-custom-card', [CustomCardsController::class, 'getCustomCardCreatePage']);
    Route::post('/create-custom-card', [CustomCardsController::class, 'store']);
    Route::get('/custom-cards-list', [CustomCardsController::class, 'getCustomCards']);
    Route::get('/custom-card/{id}', [CustomCardsController::class, 'getSingleCustomCard']);
    Route::get('/custom-card-update/{id}', [CustomCardsController::class, 'getCustomCardUpdatePage']);
    Route::post('/custom-card-update', [CustomCardsController::class, 'update']);
    Route::post('/custom-card-disable', [CustomCardsController::class, 'updateCustomCardStatus']);

    /*
     * Pet Tags
     */
    Route::get('/create-pet-tag', [PetTagController::class, 'getPetTagCreatePage']);
    Route::post('/create-pet-tag', [PetTagController::class, 'store']);
    Route::get('/pet-tags-list', [PetTagController::class, 'getPetTags']);
    Route::get('/pet-tag/{id}', [PetTagController::class, 'getSinglePetTag']);
    Route::get('/pet-tag-update/{id}', [PetTagController::class, 'getPetTagUpdatePage']);
    Route::post('/pet-tag-update', [PetTagController::class, 'update']);
    Route::post('/pet-tag-disable', [PetTagController::class, 'updatePetTagStatus']);

    /*
     * Storage Tags
     */
    Route::get('/create-storage-tag', [StorageTagController::class, 'getStorageTagCreatePage']);
    Route::post('/create-storage-tag', [StorageTagController::class, 'store']);
    Route::get('/storage-tags-list', [StorageTagController::class, 'getStorageTags']);
    Route::get('/storage-tag/{id}', [StorageTagController::class, 'getSingleStorageTag']);
    Route::get('/storage-tag-update/{id}', [StorageTagController::class, 'getStorageTagUpdatePage']);
    Route::post('/storage-tag-update', [StorageTagController::class, 'update']);
    Route::post('/storage-tag-disable', [StorageTagController::class, 'updateStorageTagStatus']);
});

require __DIR__.'/auth.php';


Route::get('/view-business-card/{token}', [BusinessCardController::class, 'viewBusinessCardOnGuest']);
Route::get('/view-secure-wallet/{token}', [WalletController::class, 'viewSecureWalletOnGuest']);
Route::get('/view-custom-card/{token}', [CustomCardsController::class, 'viewCustomCardOnGuest']);
Route::get('/view-pet-tag/{token}', [PetTagController::class, 'viewPetTagOnGuest']);
Route::get('/view-storage-tag/{token}', [StorageTagController::class, 'viewStorageTagOnGuest']);
Route::post('/verify-otp', [WalletController::class, 'verifyOtp']);
Route::get('/resend-otp', [WalletController::class, 'resendOtp']);

Route::get('/forgot-password', function () {
    return view('auth/forgot-password');
});

//Route::get('/confirmotp', function () {
//    return view('auth/confirm-otp');
//});

Route::get('/verify-email', function () {
    return view('auth/verify-email');
})->name('user.infoVerifyEmail');

Route::get('/temporary-disable', function () {
    return view('pages/temporary-disable');
});
