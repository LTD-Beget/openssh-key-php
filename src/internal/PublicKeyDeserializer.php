<?php

namespace OpenSSH\internal;

use OpenSSH\exceptions\MalformedKeyException;
use OpenSSH\PublicKey;
use OpenSSH\PublicKey\OptionNoValue;
use OpenSSH\PublicKey\OptionRepeated;
use OpenSSH\PublicKey\Options;
use OpenSSH\PublicKey\OptionSingle;
use OpenSSH\PublicKey\Type;

class PublicKeyDeserializer
{
    use PublicKeyOptionFactory;
    /** @var array */
    private $key;
    /** @var Options */
    private $options;

    /**
     * PublicKeyDeserializer constructor.
     * @param array $key
     */
    public function __construct(array $key)
    {
        $this->key = $key;
    }

    /**
     * @return PublicKey
     * @throws MalformedKeyException
     */
    public function deserialize(): PublicKey
    {
        return new PublicKey(
            $this->deserializeType(),
            $this->deserializeKey(),
            $this->deserializeComment(),
            $this->deserializeOptions()
        );
    }

    /**
     * @return Type
     * @throws MalformedKeyException
     */
    private function deserializeType(): Type
    {
        try {
            return Type::byValue($this->key['type']);
        } catch (\InvalidArgumentException $e) {
            throw new MalformedKeyException("Unknown key type '{$this->key['type']}'");
        }
    }

    /**
     * @return string
     */
    private function deserializeKey(): string
    {
        return $this->key['key'];
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

        foreach ($this->key['options'] as $name => $value) {
            $option = self::createOptionByName($name);

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
