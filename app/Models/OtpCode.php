<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtpCode extends Model
{
    use HasFactory;
    protected $fillable = ['otp', 'otp_expires_at', 'user_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
