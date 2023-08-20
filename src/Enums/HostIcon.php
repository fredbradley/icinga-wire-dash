<?php

namespace FredBradley\IcingaWireDash\Enums;

enum HostIcon:string
{
    case WIFI = 'wifi';
    case SWITCHES = 'sitemap';
    case CCTV = 'camera-cctv';
    case VM = 'network';

    public function getIcon(): string
    {
        return $this->value;
    }
    public static function iconFromGroups(array $groups) {
        $groups = array_map(fn($group) => strtolower($group), $groups);
        if (in_array('vm', $groups)) {
            return self::VM;
        }
        if (in_array('access-points', $groups)) {
            return self::WIFI;
        }
        if (in_array('switches', $groups)) {
            return self::SWITCHES;
        }
        if (in_array('cctv', $groups)) {
            return self::CCTV;
        }
        return json_encode($groups);
    }
}
