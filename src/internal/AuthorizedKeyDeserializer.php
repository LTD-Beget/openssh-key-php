<?php

namespace OpenSSH\internal;

use OpenSSH\AuthorizedKey;
use OpenSSH\AuthorizedKey\OptionNoValue;
use OpenSSH\AuthorizedKey\OptionRepeated;
use OpenSSH\AuthorizedKey\Options;
use OpenSSH\AuthorizedKey\OptionSingle;
use OpenSSH\exceptions\MalformedKeyException;
use OpenSSH\PublicKey;
use OpenSSH\PublicKey\Type;

class AuthorizedKeyDeserializer
{
    /** @var array */
    private $key;
    /** @var Options */
    private $options;

    /**
     * AuthorizedKeyDeserializer constructor.
     * @param array $key
     */
    public function __construct(array $key)
    {
        $this->key = $key;
    }

    /**
     * @return AuthorizedKey
     * @throws MalformedKeyException
     */
    public function deserialize(): AuthorizedKey
    {
        return (new AuthorizedKey($this->deserializePublicKey()))
            ->setComment($this->deserializeComment())
            ->setOptions($this->deserializeOptions());
    }

    /**
     * @return PublicKey
     * @throws MalformedKeyException
     */
    private function deserializePublicKey(): PublicKey
    {
        return (new PublicKey($this->deserializeType(), $this->key['key']))->validate();
    }

    /**
     * @return Type
     * @throws MalformedKeyException
     */
    private function deserializeType(): Type
    {
        try {
            return Type::get($this->key['type']);
        } catch (\InvalidArgumentException $e) {
            throw new MalformedKeyException("Unknown key type '{$this->key['type']}'");
        }
    }

    /**
     * @return string
     */
    private function deserializeComment(): string
    {
        return $this->key['comment'];
    }

    /**
     * @return Options
     * @throws MalformedKeyException
     */
    private function deserializeOptions(): Options
    {
        $this->options = new Options();

        foreach ($this->key['options'] as ['name' => $name, 'value' => $value]) {
            $option = AuthorizedKeyOptionFactory::createOptionByName($name);

            if ($option instanceof OptionNoValue) {
                $this->deserializeOptionNoValue($option);
            } elseif ($option instanceof OptionSingle) {
                $this->deserializeOptionSingle($option, $value);
            } elseif ($option instanceof OptionRepeated) {
                $this->deserializeOptionRepeated($option, $value);
            }
        }

        return $this->options;
    }

    /**
     * @param OptionNoValue $option
     * @throws MalformedKeyException
     */
    private function deserializeOptionNoValue(OptionNoValue $option): void
    {
        if ($this->options->has($option::getName())) {
            throw new MalformedKeyException("Duplicate option {$option::getName()}");
        }

        $this->options->set($option);
    }

    /**
     * @param OptionSingle $option
     * @param string $value
     * @throws MalformedKeyException
     */
    private function deserializeOptionSingle(OptionSingle $option, string $value): void
    {
        if ($this->options->has($option::getName())) {
            throw new MalformedKeyException("Duplicate option {$option::getName()}");
        }

        $this->options->set($option->setValue($value));
    }

    /**
     * @param OptionRepeated $option
     * @param string $value
     */
    private function deserializeOptionRepeated(OptionRepeated $option, string $value): void
    {
        if ($this->options->has($option::getName())) {
            $option::from($this->options)->addValue($value);
        } else {
            $this->options->set($option->addValue($value));
        }
    }
}
