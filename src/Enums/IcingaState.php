<?php

namespace FredBradley\IcingaWireDash\Enums;

enum IcingaState
{
    case OK;
    case WARNING;
    case CRITICAL;
    case UNKNOWN;
    case PENDING;

    public static function fromApi(int $state)
    {
        return match ($state) {
            0 => self::OK,
            1 => self::WARNING,
            2 => self::CRITICAL,
            3 => self::UNKNOWN,
            4 => self::PENDING,
        };
    }

    public function asText(): string
    {
        return match ($this) {
            self::OK => 'OK',
            self::WARNING => 'WARNING',
            self::CRITICAL => 'CRITICAL',
            self::UNKNOWN => 'UNKNOWN',
            self::PENDING => 'PENDING',
        };
    }

    public function asIcon(): string
    {
        return match ($this) {
            self::OK => 'clipboard-check',
            self::WARNING => 'engine-warning',
            self::CRITICAL => 'cross-circle',
            self::UNKNOWN => 'question',
            self::PENDING => 'clock',
        };
    }

    public function cssClass(): string
    {
        return match ($this) {
            self::OK => 'icinga-success bg-success',
            self::WARNING => 'icinga-warning bg-warning',
            self::CRITICAL => 'icinga-danger bg-error text-white',
            self::UNKNOWN => 'icinga-secondary',
            self::PENDING => 'icinga-primary',
        };
    }
}
