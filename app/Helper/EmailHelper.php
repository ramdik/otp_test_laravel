<?php

namespace App\Helper;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class EmailHelper 
{
    // Menggenerate OTP
    public function generateNumberOTP($n=4) {
        $iDigits = '135792468';
        $iOtp = '';
        for ($i=1; $i <= $n ; $i++) { 
            $iOtp .= substr($iDigits, (rand()%(strlen($iDigits))), 1);
        }
        $iOtp;
        return $iOtp;
    }
}