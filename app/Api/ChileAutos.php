<?php 

namespace App\Api;

class ChileAutos
{
    const API_BASE_PATH = 'https://id.s.core.csnglobal.net';

    protected $client;

    public function __construct() {

        $this->client = new \GuzzleHttp\Client( [
            'application/x-www-form-urlencoded',
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);
    }

    public function connect()
    {
        $response = $this->client->request('POST', self::API_BASE_PATH . '/connect/token', [
            'form_params' => [
                'client_id' => '464f4235-8052-4832-a5ea-6738021263fe',
                'client_secret' => 'Cen/5ic8fYtGbHMD4lU8VYHZ5/sJsU/N4qrl9V2DIzU=',
                'grant_type' => 'client_credentials',
            ]
        ]);

        $response = json_decode((string)$response->getBody());

        return $response->access_token;
    }

    public function addVehicle() {
       

        $response = $this->client->request('POST', $this->client['basePath'] . '/connect/token', [
            'form_params' => [
                'client_id' => '464f4235-8052-4832-a5ea-6738021263fe',
                'client_secret' => 'Cen/5ic8fYtGbHMD4lU8VYHZ5/sJsU/N4qrl9V2DIzU=',
                'grant_type' => 'client_credentials',
            ]
        ]);

        $response = json_decode((string)$response->getBody());

        dump($response);
    }
}