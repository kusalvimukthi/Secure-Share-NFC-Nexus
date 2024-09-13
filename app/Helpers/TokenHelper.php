<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;
use Exception;

class TokenHelper
{
    public static function createToken($data): ?string
    {
        try {
            return Crypt::encrypt($data);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function readToken($token)
    {
        try {
            return Crypt::decrypt($token);
        } catch (Exception $e) {
            return null;
        }
    }
}
