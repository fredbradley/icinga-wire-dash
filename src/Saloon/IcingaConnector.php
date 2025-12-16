<?php

namespace FredBradley\IcingaWireDash\Saloon;

use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class IcingaConnector extends Connector
{
    use AcceptsJson, AlwaysThrowOnErrors;

    public function __construct()
    {
        $config = config('icinga-wire-dash');
        $this->authenticate(new BasicAuthenticator($config['username'], $config['password']));
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
