<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetTag extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'email', 'tel_no', 'address', 'pet_name', 'bio', 'avatar', 'date_of_birth', 'vaccination_details','status'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
