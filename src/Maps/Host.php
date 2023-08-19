<?php

namespace FredBradley\IcingaWireDash\Maps;

use FredBradley\IcingaWireDash\Resources\HostResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\MissingAttributeException;

class Host implements \JsonSerializable, \ArrayAccess
{
    use HasAttributes;

    public function __construct($properties)
    {
        $this->attributes = $properties;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }
    public function getAttributes(): array
    {
        return $this->properties['attrs'];
    }

    public function getName(): string
    {
        return $this->properties['name'];
    }

    public function getType(): string
    {
        return $this->properties['type'];
    }

    public function __get($name)
    {
        return $this->getAttributes()[$name];
    }

    public function jsonSerialize(): mixed
    {
        return $this->properties;
    }

    public function offsetExists(mixed $offset): bool
    {
        try {
            return ! is_null($this->getAttribute($offset));
        } catch (MissingAttributeException) {
            return false;
        }

        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset): mixed
    {
        return $this->getAttribute($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->setAttribute($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        unset($this->attributes[$offset], $this->relations[$offset]);
    }
}
