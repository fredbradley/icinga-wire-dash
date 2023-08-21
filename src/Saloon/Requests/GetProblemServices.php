<?php

namespace FredBradley\IcingaWireDash\Saloon\Requests;

use FredBradley\IcingaWireDash\Saloon\DataTransferObjects\HostCollection;
use FredBradley\IcingaWireDash\Saloon\DataTransferObjects\ServiceCollection;
use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use Saloon\Contracts\Connector;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;

class GetProblemServices extends Request
{
    use HasConnector;

    protected Method $method = Method::GET;

    protected function resolveConnector(): Connector
    {
        return new IcingaConnector();
    }

    public function resolveEndpoint(): string
    {
        return '/objects/services?joins=host&filter=service.state!=ServiceOK';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return ServiceCollection::fromResponse($response);
    }
}
