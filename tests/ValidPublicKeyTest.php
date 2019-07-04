<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace OpenSSH;

use PHPUnit\Framework\TestCase;

class ValidPublicKeyTest extends TestCase
{
    public function testWithoutOptions()
    {
        $plainText = 'ssh-rsa base64encodedkeyhere== key without options';

        $key = PublicKey::fromString($plainText);

        $this->assertTrue($key->getType()->is(PublicKey\Type::SSH_RSA));
        $this->assertEquals('base64encodedkeyhere==', $key->getKey());
        $this->assertEquals('key without options', $key->getComment());
        $this->assertEmpty($key->getOptions());

        $this->assertEquals($plainText, $key->toString());
    }
}
