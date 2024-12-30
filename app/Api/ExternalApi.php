<?php

namespace App\Api;

abstract class ExternalApi
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $config;

    public function __construct($config = [])
    {
        $this->config = $config;
        
        // Create Guzzle client upon instantiation
        $this->createClient();
    }

    /**
     * Create Guzzle-client for future requests
     * 
     * @return void
     */
    protected function createClient()
    {
        $this->client = new \GuzzleHttp\Client( [
            'cookies' => false,
            'application/x-www-form-urlencoded',
            'headers' => [
				'accept'            => 'application/json',
				'accept-encoding'	=> 'gzip',
                'cache-control'     => 'no-cache',
            ]
        ]);
    }
}
