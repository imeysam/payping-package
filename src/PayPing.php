<?php

namespace AMeysam\PayPing;

class PayPing
{

    /**
     * Get token to call another method.
     *
     * Call ones and get your token and set it token to config payping.php file in config folder.
     */
    public static function getToken()
    {

        $url = URL::getApiUrl('GetToken');

        $curl = new CURL($url);

        $body = [
            'grant_type' => 'password',
            'username' => config('payping.username'),
            'password' => config('payping.password'),
        ];

        $curl->init('post', $body, true);

        $curl->setHeader([
            'Content-Type:application/x-www-form-urlencoded'
        ]);

        $result = $curl->exec();

        $curl->close();

        return $result;

    }


    /**
     * Get user key to call another methods.
     *
     * Call after getToken() to get user key and set to payping.php file in config folder.
     */
    public static function getUserKey()
    {
        $url = URL::getApiUrl('GetUserKey') . config('payping.username');

        $curl = new CURL($url);

        $curl->init('get');

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $code = str_replace('"', '', $curl->exec());

        $curl->close();

        return $code;
    }


    /**
     * Call any time that you want to connect to payment page.
     * 
     * @param array $body: body of request.
     * 
     * @return mixed
     */
    public static function requestToken(array $body)
    {
        $url = URL::getApiUrl('RequestToken');

        $curl = new CURL($url);

        $body['UserKey'] = $body['UserKey'] ?? config('payping.user-key');

        $body['ReturnUrl'] = $body['ReturnUrl'] ?? config('payping.return-url');

        $curl->init('post', $body);

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $code = str_replace('"', '', $curl->exec());

        $curl->close();

        return $code;

    }

    /**
     * Redirect to payment page.
     * 
     * Call after requestToken().
     * 
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function pay($code)
    {
        $url = URL::getUrl('Pay');

        return redirect()->away("{$url}{$code}");
    }

    /**
     * Verify a payment.
     * 
     * Call after a payment is finish.
     * 
     * @param array $body
     * @return mixed
     */
    public static function verifyPayment(array $body)
    {
        $url = URL::getApiUrl('VerifyPayment');

        $curl = new CURL($url);

        $body['UserKey'] = config('payping.user-key');

        $curl->init('post', $body);

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $result = $curl->exec();

        $curl->close();

        return $result;
    }

    /**
     * Get all of un verified payments.
     *
     * @return mixed
     */
    public static function unVerifiedPayments()
    {
        $url = URL::getApiUrl('UnVerifiedPayments');

        $curl = new CURL($url);

        $curl->init('get');

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $result = $curl->exec();

        $curl->close();

        return $result;
    }


    /**
     * Get all of verified payments.
     *
     * @return mixed
     */
    public static function allVerifiedPayments()
    {
        $url = URL::getApiUrl('AllVerifiedPayments');

        $curl = new CURL($url);

        $curl->init('get');

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $result = $curl->exec();

        $curl->close();

        return $result;
    }

}