<?php

namespace OpenSSH\PublicKey;

abstract class OptionRepeated extends Option
{
    /** @var string[] */
    private $values = [];

    /**
     * @return string[]
     */
    public function getValues(): array
    {
        return array_values($this->values);
    }

    /**
     * @param string[] $values
     * @return OptionRepeated
     */
    public function setValues(array $values): OptionRepeated
    {
        $this->values = [];

        foreach ($values as $value) {
            $this->addValue($value);
        }
        return $this;
    }

    /**
     * @param string $value
     * @return OptionRepeated
     */
    public function addValue(string $value): OptionRepeated
    {
        $this->values[] = $value; // TODO quoting
        return $this;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        // TODO: Implement toString() method.
        return '';
    }
}
