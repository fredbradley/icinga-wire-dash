<?php

namespace FredBradley\IcingaWireDash\Saloon\Requests;

use FredBradley\IcingaWireDash\Saloon\DataTransferObjects\HostCollection;
use FredBradley\IcingaWireDash\Saloon\DataTransferObjects\ServiceCollection;
use Saloon\Contracts\Response;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetProblemServices extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/objects/services?filter=service.state!=ServiceOK';
    }
    public function createDtoFromResponse(Response $response): mixed
    {
        return ServiceCollection::fromResponse($response);
    }
}
