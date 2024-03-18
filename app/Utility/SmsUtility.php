<?php

namespace App\Utility;

use App\Models\SmsProvider;
use App\Models\SmsTemplate;
class SmsUtility
{
    public static function sendSMS($to, $body)
    {
        $token = "075d49e5ee89bb80c74bc5b0bb490f82";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data= array(
            'to'=>"$to",
            'message'=>"$body",
            'token'=>"$token"
        );
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
    }
}
