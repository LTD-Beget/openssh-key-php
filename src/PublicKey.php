<?php

namespace OpenSSH;

use OpenSSH\internal\PublicKeyParser;
use OpenSSH\PublicKey\Options;
use OpenSSH\PublicKey\Type;

class PublicKey
{
    /** @var Type */
    private $type;
    /** @var string */
    private $key;
    /** @var string */
    private $comment;
    /** @var Options */
    private $options;

    /**
     * PublicKey constructor.
     * @param Type $type
     * @param string $key
     * @param string $comment
     * @param Options|null $options
     */
    public function __construct(Type $type, string $key, string $comment = '', Options $options = null)
    {
        $this->setType($type);
        $this->setKey($key);
        $this->setComment($comment);
        $this->setOptions($options ?? new Options());
    }

    /**
     * @param string $key
     * @return PublicKey
     * @throws exceptions\MalformedKeyException
     */
    static function fromString(string $key): PublicKey
    {
        return (new PublicKeyParser($key))->parse();
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
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return PublicKey
     */
    public function setComment(string $comment): PublicKey
    {
        $this->comment = trim($comment);
        return $this;
    }

    /**
     * @return bool
     */
    public function hasComment(): bool
    {
        return strlen($this->comment) > 0;
    }

    /**
     * @return Options
     */
    public function getOptions(): Options
    {
        return $this->options;
    }

    /**
     * @param Options $options
     * @return PublicKey
     */
    public function setOptions(Options $options): PublicKey
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasOptions(): bool
    {
        return count($this->getOptions()) > 0;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        $parts = [
            $this->getOptions()->toString(),
            $this->getType()->getValue(),
            $this->getKey(),
            $this->getComment(),
        ];

        if (!$this->hasOptions()) {
            array_shift($parts);
        }

        if (!$this->hasComment()) {
            array_pop($parts);
        }

        return implode(' ', $parts);
    }
}
