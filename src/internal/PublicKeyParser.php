<?php

namespace OpenSSH\internal;

use OpenSSH\exceptions\MalformedKeyException;
use OpenSSH\PublicKey;

class PublicKeyParser
{
    /** @var string */
    private $key;

    /**
     * PublicKeyParser constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return PublicKey
     * @throws MalformedKeyException
     */
    public function parse(): PublicKey
    {
        return (new PublicKeyDeserializer($this->tokenize()))->deserialize();
    }

    /**
     * @return array
     * @throws MalformedKeyException
     */
    private function tokenize(): array
    {
        // TODO replace with real implementation
        $tokens = explode(' ', $this->key, 3);

        if (count($tokens) !== 3) {
            throw new MalformedKeyException('Malformed key');
        }

        return [
            'type'    => $tokens[0],
            'key'     => $tokens[1],
            'comment' => $tokens[2],
            'options' => [],
        ];
    }
}
