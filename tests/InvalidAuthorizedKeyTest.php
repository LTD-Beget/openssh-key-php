<?php

namespace OpenSSH\tests;

use OpenSSH\AuthorizedKey;
use OpenSSH\exceptions\MalformedKeyException;
use PHPUnit\Framework\TestCase;

class InvalidAuthorizedKeyTest extends TestCase
{
    /**
     * @throws MalformedKeyException
     */
    public function testEmpty()
    {
        $this->expectException(MalformedKeyException::class);
        $this->expectExceptionMessage('Unexpected end at position 0');

        AuthorizedKey::fromString('');
    }

    /**
     * @throws MalformedKeyException
     */
    public function testNonBase64Key()
    {
        $this->expectException(MalformedKeyException::class);
        $this->expectExceptionMessage('Malformed base64 encoding');

        AuthorizedKey::fromString('ssh-rsa nonbase64');
    }

    /**
     * @throws MalformedKeyException
     */
    public function testUnknownOption()
    {
        $this->expectException(MalformedKeyException::class);
        $this->expectExceptionMessage("Unknown option name 'reconnect'");

        AuthorizedKey::fromString('reconnect ssh-rsa d2VsbCwgdGhhdHMgYmFzZTY0');
    }

    /**
     * @throws MalformedKeyException
     */
    public function testDuplicateOption()
    {
        $this->expectException(MalformedKeyException::class);
        $this->expectExceptionMessage("Duplicate option from");

        AuthorizedKey::fromString('from="192.168.1.1/32",from="10.101.0.0/16" ssh-rsa d2VsbCwgdGhhdHMgYmFzZTY0');
    }

    /**
     * @throws MalformedKeyException
     */
    public function testUnexpectedCharacter()
    {
        $this->expectException(MalformedKeyException::class);
        $this->expectExceptionMessage("Unexpected character '*' at position 4");

        AuthorizedKey::fromString('opti*n=foo ssh-rsa nonsense');
    }
}