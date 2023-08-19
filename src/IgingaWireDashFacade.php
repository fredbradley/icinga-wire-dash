<?php

namespace Fredbradley\IgingaWireDash;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fredbradley\IgingaWireDash\Skeleton\SkeletonClass
 */
class IgingaWireDashFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'iginga-wire-dash';
    }
}
