<?php

namespace FredBradley\IcingaWireDash;

use Illuminate\Support\Facades\Facade;

/**
 * @see \FredBradley\IcingaWireDash\Skeleton\SkeletonClass
 */
class IcingaWireDashFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'icinga-wire-dash';
    }
}
