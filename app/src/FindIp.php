<?php

namespace NorteDev;

class FindIp
{
    private string $endpoint = 'http://api.ipstack.com/';
    private string $access_key = '8ae49aae6f84d0587f5d96bf83c47082';
    private ?string $result = null;

    public function __construct($ip)
    {
        if (is_null($ip)) {
            throw new \Exception('IP é requerido');
        }
        $query = ["access_key" => $this->access_key];
        $ch = curl_init("{$this->endpoint}{$ip}?" . http_build_query($query));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->result = curl_exec($ch);
    }

    public function response()
    {
        return json_decode($this->result, true);
    }
}