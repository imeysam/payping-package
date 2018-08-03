<?php

namespace AMeysam\PayPing;


class CURL
{

    /**
     * @var url
     */
    private $url;

    /**
     * curl object.
     *
     * @var object
     */
    private $curl;


    /**
     *
     * CURL constructor.
     * @param $url string.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Initialize curl.
     *
     * @param string $method
     * @param array $body
     * @param bool $build_query
     */
    public function init($method = 'post', $body = [], $build_query = false)
    {
        $curl = curl_init($this->url);

        if($build_query)
        {
            $payload = http_build_query($body);
        }
        else
        {
            $payload = json_encode($body);
        }

        if($method == 'post')
        {
            curl_setopt( $curl, CURLOPT_POST, true );
            curl_setopt( $curl, CURLOPT_POSTFIELDS, $payload);
        }

        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

        $this->curl = $curl;
    }


    /**
     * Set headers to curl request.
     *
     * @param array $headers
     */
    public function setHeader($headers)
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * Close curl.
     */
    public function close()
    {
        curl_close($this->curl);
    }

    /**
     * Execute curl.
     *
     * @return mixed
     */
    public function exec()
    {
        return curl_exec($this->curl);
    }

    /**
     * Return current curl.
     *
     * @return object
     */
    public function get()
    {
        return $this->curl;
    }
}