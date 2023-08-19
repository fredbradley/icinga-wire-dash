<?php

namespace FredBradley\IcingaWireDash\Saloon\Requests;

use FredBradley\IcingaWireDash\Saloon\DataTransferObjects\Host;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetProblemHosts extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/objects/hosts?filter=host.state!=ServiceOK';
    }
    public function createDtoFromResponse(Response $response): mixed
    {
        return Host::fromResponse($response);
    }
}
