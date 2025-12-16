<?php

namespace FredBradley\IcingaWireDash;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class IcingaWireDash
{
    private array $config;

    public PendingRequest $client;

    // Build your next great package.
    public function __construct()
    {
        $this->config = config('icinga-wire-dash');

        $this->client = Http::acceptJson()
            ->withBasicAuth(
                $this->config['username'],
                $this->config['password']
            )->baseUrl($this->config['base_url'])
            ->withOptions([
                'verify' => $this->config['ssl_verify'],
            ]);
    }

    /**
     * @throws RequestException
     */
    public function get(string $url): object
    {
        return $this->client->get($url)->throw()->object();
    }

    /**
     * @throws RequestException
     */
    public function post(string $url, array $data): object
    {
        return $this->client->post($url, $data)->throw()->object();
    }

    /**
     * @throws RequestException
     */
    public function getHostProblems(): object
    {
        return $this->client->get('objects/hosts?filter=host.state!=ServiceOK')
            ->throw()
            ->collect();
    }
}
