<?php


namespace Hanson\Tuling;


class Encrypter
{

    public static function signature($key, $secret, $param)
    {
        $aseKey = md5($secret.time().$key);

        $iv = '';

        $iv .= str_repeat(chr(0), 16);

        $cipher = openssl_encrypt(json_encode($param), 'aes-128-cbc', hash('MD5', $aseKey, true), OPENSSL_RAW_DATA, $iv);

        return ['key' => $key, 'timestamp' => time(), 'data' => base64_encode($cipher)];
    }

}