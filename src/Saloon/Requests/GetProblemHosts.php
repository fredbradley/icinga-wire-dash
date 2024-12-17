<?php

namespace FredBradley\IcingaWireDash\Saloon\Requests;

use FredBradley\IcingaWireDash\Saloon\DataTransferObjects\HostCollection;
use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;

class GetProblemHosts extends Request
{
    use HasConnector;

    protected Method $method = Method::GET;

    protected function resolveConnector(): Connector
    {
        return new IcingaConnector();
    }

    public function resolveEndpoint(): string
    {
        return '/objects/hosts';
    }

    protected function defaultQuery(): array
    {
        return [
            'filter' => 'host.state!=ServiceOK',
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return HostCollection::fromResponse($response);
    }
}
