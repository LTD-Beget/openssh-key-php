<?php

namespace LTDBeget\openssh;

use LTDBeget\openssh\exceptions\MalformedKeyException;
use LTDBeget\openssh\PublicKey\Type;

class PublicKey
{
    /** @var Type */
    private $type;
    /** @var string */
    private $key;

    /**
     * PublicKey constructor.
     * @param Type $type
     * @param string $key
     */
    public function __construct(Type $type, string $key)
    {
        $this->setType($type);
        $this->setKey($key);
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return PublicKey
     */
    public function setType(Type $type): PublicKey
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     * @return PublicKey
     */
    public function setKey(string $key): PublicKey
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return PublicKey
     * @throws MalformedKeyException
     */
    public function validate(): PublicKey
    {
        if ($this->getKey() === '') {
            throw new MalformedKeyException('Empty public key value');
        }

        $decoded = base64_decode($this->getKey(), true);

        if ($decoded === false || $this->getKey() !== base64_encode($decoded)) {
            throw new MalformedKeyException('Malformed base64 encoding');
        }
        return $this;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return implode(' ', [$this->getType()->getValue(), $this->getKey()]);
    }
}
