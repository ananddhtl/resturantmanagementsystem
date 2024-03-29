<?php

namespace App\Helpers;

class  VerificationHelpers
{
    static function generateVerificationCode()
    {
        if (config('constant.app_env') === "local")
            return 12345;
        else return rand(10000, 99999);
    }
}
