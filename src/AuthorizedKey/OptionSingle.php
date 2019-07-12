<?php

namespace OpenSSH\AuthorizedKey;

abstract class OptionSingle extends Option
{
    /** @var string */
    private $value = '';

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return OptionSingle
     */
    public function setValue(string $value): OptionSingle
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->getKeyValueSerializer()($this->value);
    }
}
