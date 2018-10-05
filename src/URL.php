<?php

namespace AMeysam\PayPing;


class URL
{
    private const API_URLs = [

        'RequestPay' => 'https://api.payping.ir/v1/pay',

        'VerifyPay' => 'https://api.payping.ir/v1/pay/verify',
        
    ];

    private const URLs = [
        'Pay' => 'https://api.payping.ir/v1/pay/gotoipg/'
    ];

    public static function getApiUrl($method)
    {
        return self::API_URLs[$method];
    }

    public static function getUrl($name)
    {
        return self::URLs[$name];
    }
}