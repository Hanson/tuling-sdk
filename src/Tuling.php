<?php


namespace Hanson\Tuling;


use GuzzleHttp\Client;

class Tuling
{

    private $key;

    private $secret;

    private $client;

    private $text;

    private $location;

    private $userId = 1;

    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->client = new Client();
    }

    /**
     * 设置文字
     *
     * @param $text
     * @return $this
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * 设置坐标
     *
     * @param array $location
     * @return $this
     */
    public function location(array $location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * 设置用户ID
     *
     * @param $userId
     * @return $this
     */
    public function user($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    private function makeRequest()
    {
        return [
            'perception' => [
                'inputText' => [
                    'text' => $this->text,
                ],
                'selfInfo' => [
                    'location' => $this->location,
                ]
            ],
            'userInfo' => [
                'apiKey' => $this->key,
                'userId' => $this->userId,
            ]
        ];
    }

    public function request($raw = false)
    {
        $params = Encrypter::signature($this->key, $this->secret, $this->makeRequest());

        $response = $this->client->post('http://openapi.tuling123.com/openapi/api/v2', [
            'json' => $params
        ]);

        $result = json_decode(strval($response->getBody()), true);

        return $raw ? $result : $result['results'][0]['values']['text'];
    }
}