<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userDetail():HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    public function businessCards():HasMany
    {
        return $this->hasMany(BusinessCard::class);
    }

    public function wallets():HasMany
    {
        return $this->hasMany(Wallet::class);
    }

    public function pet_tags():HasMany
    {
        return $this->hasMany(PetTag::class);
    }

    public function storage_tags():HasMany
    {
        return $this->hasMany(StorageTag::class);
    }

    public function custom_cards():HasMany
    {
        return $this->hasMany(CustomCard::class);
    }

    public function otp_code():HasOne
    {
        return $this->hasOne(OtpCode::class);
    }

    public static function abort($status, $message = "User does not have any of the necessary access rights.")
    {
        return abort($status, __($message));
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}
