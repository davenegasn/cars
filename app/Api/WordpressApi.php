<?php

namespace App\Api;

use App\Models\Brand;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WordPressApi
{
    protected $client;
    protected $baseUri;
    protected $username;
    protected $password;

    const BASEURI = 'https://maqueta.online';
    const VEHICLE_ENDPOINT = '/automotoras/wp-json/wp/v2/automoviles';
    const BRAND_ENDPOINT = '/automotoras/wp-json/wp/v2/marcas-of';
    const EQUIPMENT_ENDPOINT = '/automotoras/wp-json/wp/v2/equipamiento';
    const TOKEN_ENDPOINT = '/automotoras/wp-json/jwt-auth/v1/token';
    const MEDIA_ENDPOINT = '/automotoras/wp-json/wp/v2/media';

    public function __construct()
    {
        // $this->baseUri = 'https://maqueta.online';
        $this->username = env('WP_USERNAME');
        $this->password = env('WP_PASSWORD');
        
        $this->client = new Client([
            'base_uri' => self::BASEURI,
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    protected function getToken()
    {
        $response = $this->client->post(self::TOKEN_ENDPOINT, [
            'json' => [
                'username' => $this->username,
                'password' => $this->password,
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Invalid credentials');
        }

        return json_decode((string) $response->getBody())->token;
    }

    protected function updateUserToken($token)
    {
        $user = User::find(1);

        if (!$user) {
            throw new \Exception('User not found');
        }

        $user->wordpress()->update([
            'token' => $token,
            'baseuri' => self::BASEURI,
            'username' => $this->username,
            'password' => $this->password,
        ]);
    }

    public function connect()
    {
        try {
            $token = $this->getToken();

            $this->updateUserToken($token);

            return $token;
        } catch (\Exception $e) {
            Log::error('Connection error: ' . $e->getMessage());

            throw $e;
        }
    }

    public function uploadImage($imagePath)
    {
        $token = $this->connect();

        try {
            $response = $this->client->post(self::MEDIA_ENDPOINT, [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'Content-Disposition' => 'attachment; filename="' . basename($imagePath) . '"',
                    'Content-Type' => mime_content_type($imagePath),
                ],
                'body' => fopen($imagePath, 'r'),
            ]);

            $data = json_decode($response->getBody(), true);

            return $data['id'];
        } catch (\Exception $e) {
            Log::error('Error uploading image: ' . $e->getMessage());

            throw $e;
        }
    }

    public function postVehicle($vehicleData)
    {
        $token = $this->connect();

        try {
            $response = $this->client->post(self::VEHICLE_ENDPOINT, [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'json' => $vehicleData
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Error creating vehicle: ' . $e->getMessage());

            throw $e;
        }
    }

    public function putVehicle($vehicle)
    {
        $token = $this->connect();

        try {
            $response = $this->client->put(self::VEHICLE_ENDPOINT, [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'json' => $vehicle
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Error updating vehicle: ' . $e->getMessage());

            throw $e;
        }
    }

    public function getVehicles(): Collection
    {
        try {
            $response = $this->client->request('GET', '/automotoras/wp-json/wp/v2/automoviles');

            $result = json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Could not get vehicles from wordpress: ' ,$e->getMessage());
            
            return collect([]);
        }

        return collect($result);
    }

    public function getEquipments(): Collection
    {
        try {
            $response = $this->client->request('GET', '/automotoras/wp-json/wp/v2/equipamiento');
            $result = json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Could not get equipment from wordpress: ' ,$e->getMessage());
            return collect([]);
        }

        return collect($result);
    }

    public function getBrands(): Collection
    {
        try {
            $response = $this->client->request('GET', '/automotoras/wp-json/wp/v2/marcas-of');
            $result =  json_decode((string) $response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Could not get brands from wordpress: ' ,$e->getMessage());
            return collect([]);
        }

        return collect($result);
    }

    public function createBrand(Brand $brand)
    {
        $token = $this->connect();

        try {
            $response = $this->client->post(self::BRAND_ENDPOINT, [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'json' => [
                    'slug' => $brand->slug,
                    'name'  => $brand->name,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Error creating brand ' . $brand->name . ' ' . $e->getMessage());

            throw $e;
        }
    }

    public function createEquipment()
    {
        $token = $this->connect();

        try {
            $response = $this->client->post(self::EQUIPMENT_ENDPOINT, [
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                ],
                'json' => [
                    'slug' => 'ya-esta',
                    'name'  => 'Ya esta',
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Error sending vehicle: ' . $e->getMessage());

            throw $e;
        }
    }
}