<?php

namespace Joomartin\Utils\Http;

class Http
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    protected $data;

    /**
     * Http constructor.
     * @param $url
     * @param array $data
     */
    public function __construct($url, array $data = [])
    {
        $this->url = $url;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function post()
    {
        $curl = curl_init($this->url);

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-Requested-With: XMLHttpRequest']);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * @param bool $json
     * @return string
     */
    public function get($json = false)
    {
        $curl = curl_init($this->url);

        curl_setopt($curl, CURLOPT_URL, $this->url . http_build_query($this->data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-Requested-With: XMLHttpRequest']);

        $response = curl_exec($curl);
        curl_close($curl);

        return ($json) ? json_decode($response, true) : $response;
    }
}