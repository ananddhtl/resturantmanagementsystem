<?php

namespace App\Helpers;

class  VerificationHelpers
{
    static function generateVerificationCode()
    {
        if (env('APP_ENV') === "local")
            return 12345;
        else return rand(10000, 99999);
    }
}
