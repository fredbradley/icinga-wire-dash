<?php

namespace FredBradley\IcingaWireDash\Saloon;

use Saloon\Http\Connector;

class IcingaConnector extends Connector
{
    public function __construct(protected string $username, protected string $password)
    {
        $this > $this->withBasicAuth($this->username, $this->password);
    }
    public function defaultConfig(): array
    {
        return [
            'timeout' => 60,
            'verify' => false,
        ];
    }

    public function resolveBaseUrl(): string
    {
        return config('icinga-wire-dash.base_url');
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'ssl_verify' => false,
        ];
    }
}
