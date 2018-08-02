<?php

namespace AMeysam\PayPing;


class URL
{
    private const API_URLs = [
        'GetToken' => 'https://api.payping.ir/token',

        'RequestToken' => 'https://api.payping.ir/v1/payment/RequestToken',

        'VerifyPayment' => 'https://api.payping.ir/v1/payment/VerifyPayment',

        'UnVerifiedPayments' => 'https://api.payping.ir/v1/payment/GetUnVerifiedPayments',

        'AllVerifiedPayments' => 'https://api.payping.ir/v1/payment/GetAllVerifiedPayments',

        'GetUserKey' => 'https://api.payping.ir/v1/payment/GetUserKey?username=',
    ];

    private const URLs = [
        'Pay' => 'https://www.payping.ir/payment/PayApi/'
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