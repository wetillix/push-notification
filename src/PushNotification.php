<?php

namespace Wetillix\PushNotification;

use GuzzleHttp\Client;

class PushNotification
{
    private array $config = [];

    /**
     * @throws \Exception
     */
    public function __construct(string $path)
    {
        $this->config = $this->processJsonFile($path);
    }


    /**
     * Device wise notification send
     */
    public function sendPushNotificationToDevice(string $fcmToken, array $data)
    {
        $postData = [
            'message' => [
                'token' => $fcmToken,
                'data' => $data,
                'notification' => $data,
            ],
        ];

        return $this->sendNotificationToHttp($postData);
    }

    public function sendPushNotificationToTopic(array $data, string $topic = 'topic')
    {
        $postData = [
            'message' => [
                'topic' => $topic,
                'data' => $data,
                'notification' => $data,
            ]
        ];
        return $this->sendNotificationToHttp($postData);
    }

    protected function sendNotificationToHttp(?array $data)
    {
        $client = new Client();

        if (isset($this->config['project_id'])) {
            $url = 'https://fcm.googleapis.com/v1/projects/'.$this->config['project_id'].'/messages:send';
            $headers = [
                'Authorization' => 'Bearer '.self::getAccessToken($this->config),
                'Content-Type' => 'application/json',
            ];
        }

        $response = $client->post($url,[
            'headers' => $headers,
            'json' => $data,
        ]);

        return json_decode($response->getBody(), true);
    }

    protected function getAccessToken($key): string
    {
        $client = new Client();

        $jwtToken = [
            'iss' => $key['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => time() + 3600,
            'iat' => time(),
        ];

        $jwtHeader = base64_encode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));

        $jwtPayload = base64_encode(json_encode($jwtToken));

        $unsignedJwt = $jwtHeader.'.'.$jwtPayload;

        openssl_sign($unsignedJwt, $signature, $key['private_key'], OPENSSL_ALGO_SHA256);

        $jwt = $unsignedJwt.'.'.base64_encode($signature);

        $response =  $client->post('https://oauth2.googleapis.com/token',[
            'json' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $jwt,
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return $data['access_token'];
    }

    /**
     * @throws \Exception
     */
    private function processJsonFile(string $filePath): array
    {
        $fileContents = file_get_contents($filePath);
        if($fileContents === false){
            throw new \Exception('Unable to read the file');
        }
        $json = json_decode($fileContents, true);

        if($json === null){
            throw new \Exception('Unable to parse the JSON string');
        }
        return $json;
    }

}
