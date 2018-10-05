<?php

namespace AMeysam\PayPing;

class PayPing
{

    /**
     * Call any time that you want to connect to payment page.
     *
     * @param array $body : body of request.
     * @param $is_redirect : If you want to redirect to the location, pass TRUE value for $redirect parameter.
     *
     * @return mixed
     */
    public static function requestPayment($body, $is_redirect = true)
    {
        $url = URL::getApiUrl('RequestPay');

        $curl = new CURL($url);

        $body['returnUrl'] = !empty($body['returnUrl']) ? $body['returnUrl'] : config('payping.return-url');

        $curl->init('post', $body);

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $result = $curl->exec();

        $result = json_decode($result, true);

        $curl->close();

        $code = $result['code'];

        return self::pay($code, $is_redirect);

    }

    /**
     * Redirect to payment page.
     *
     * Call after requestToken().
     *
     * @param $code
     * @param $redirect
     * @return \Illuminate\Http\RedirectResponse
     */
    private static function pay($code, $redirect)
    {
        $url = URL::getUrl('Pay');

        $location = "{$url}{$code}";

        /** */
        if ($redirect)
        {
            return redirect()->away($location);
        }

        return $location;
    }

    /**
     * Verify a payment.
     *
     * Call after a payment is finish.
     *
     * @param array $body
     * @return mixed
     */
    public static function verifyPayment($body)
    {
        $url = URL::getApiUrl('VerifyPay');

        $curl = new CURL($url);

        $curl->init('post', $body);

        $curl->setHeader([
            'Content-Type:application/json',
            'Authorization:Bearer ' . config('payping.token'),
        ]);

        $result = $curl->exec();

        $curl->close();

        if (!$result && http_response_code() === 200)
        {
            return ['status' => true];
        }

        return [
            'status' => false,
            'message' => str_replace('"', '', $result),
        ];
    }
}