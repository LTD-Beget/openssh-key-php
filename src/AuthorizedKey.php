<?php

namespace LTDBeget\openssh;

use LTDBeget\openssh\AuthorizedKey\Option;
use LTDBeget\openssh\AuthorizedKey\Options;
use LTDBeget\openssh\exceptions\MalformedKeyException;
use LTDBeget\openssh\internal\AuthorizedKeyParser;

class AuthorizedKey
{
    /** @var PublicKey */
    private $publicKey;
    /** @var string */
    private $comment = '';
    /** @var Options */
    private $options;

    /**
     * AuthorizedKey constructor.
     * @param PublicKey $publicKey
     */
    public function __construct(PublicKey $publicKey)
    {
        $this->setPublicKey($publicKey);
        $this->setOptions(new Options());
    }

    /**
     * @param string $key
     * @return AuthorizedKey
     * @throws MalformedKeyException
     */
    static function fromString(string $key): AuthorizedKey
    {
        return (new AuthorizedKeyParser($key))->parse();
    }

    /**
     * @return PublicKey
     */
    public function getPublicKey(): PublicKey
    {
        return $this->publicKey;
    }

    /**
     * @param PublicKey $publicKey
     * @return AuthorizedKey
     */
    public function setPublicKey(PublicKey $publicKey): AuthorizedKey
    {
        $this->publicKey = $publicKey;
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
     * @return AuthorizedKey
     */
    public function setComment(string $comment): AuthorizedKey
    {
        $this->comment = trim($comment);
        return $this;
    }

    /**
     * @return bool
     */
    public function hasComment(): bool
    {
        return $this->comment !== '';
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
     * @return AuthorizedKey
     */
    public function setOptions(Options $options): AuthorizedKey
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
     * @param Option $option
     * @return AuthorizedKey
     */
    public function setOption(Option $option): AuthorizedKey
    {
        $this->options->set($option);

        return $this;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        $parts = [
            $this->getOptions()->toString(),
            $this->getPublicKey()->toString(),
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
