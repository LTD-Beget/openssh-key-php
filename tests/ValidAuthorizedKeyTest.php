<?php

namespace LTDBeget\openssh\tests;

use LTDBeget\openssh\AuthorizedKey;
use LTDBeget\openssh\AuthorizedKey\Option;
use LTDBeget\openssh\exceptions\MalformedKeyException;
use LTDBeget\openssh\PublicKey;
use LTDBeget\openssh\PublicKey\Type;
use PHPUnit\Framework\TestCase;

class ValidAuthorizedKeyTest extends TestCase
{
    /**
     * @throws MalformedKeyException
     */
    public function testUsage(): void
    {
        $plainText = 'ssh-rsa Zm9vYmFy key without options';

        $key = AuthorizedKey::fromString($plainText);

        $this->assertTrue($key->getPublicKey()->getType()->is(Type::SSH_RSA()));
        $this->assertEquals('Zm9vYmFy', $key->getPublicKey()->getKey());
        $this->assertEquals('key without options', $key->getComment());
        $this->assertEmpty($key->getOptions());

        $this->assertEquals($plainText, $key->toString());
    }

    /**
     * @throws MalformedKeyException
     */
    public function testOptions(): void
    {
        $publicKey = (new PublicKey(Type::SSH_ED25519(), 'Zm9vYmFy'))->validate();

        $authorizedKey = (new AuthorizedKey($publicKey))
            ->setOption((new Option\From())->setValue('192.168.0.0/16'))
            ->setOption((new Option\Environment())->setValues(['foo=bar', 'empty=']))
            ->setComment('admin@localhost');

        $this->assertEquals(implode(' ', [
            'from="192.168.0.0/16",environment="foo=bar",environment="empty="',
            'ssh-ed25519 Zm9vYmFy',
            'admin@localhost',
        ]), $authorizedKey->toString());
    }

    /**
     * @throws MalformedKeyException
     */
    public function testLeadingSpace(): void
    {
        $plainText = 'ssh-rsa dGVzdA==';

        $key = AuthorizedKey::fromString('  ' . $plainText);

        $this->assertEquals($plainText, $key->toString());
    }

    /**
     * @dataProvider plainTextKeysProvider
     *
     * @param string $plainText
     * @throws MalformedKeyException
     */
    public function testInvariance(string $plainText): void
    {
        $key = AuthorizedKey::fromString($plainText);

        $this->assertEquals($plainText, $key->toString());
    }

    /**
     * @return array
     */
    public function plainTextKeysProvider(): array
    {
        return [
            'simple'          => ['ssh-rsa dGVzdA=='],
            'with options'    => ['from="123.123.123.0/24",command="/bin/bash -c \\"echo 1\\"" ssh-rsa Zm9vYmFy'],
            'escaping'        => ['command="echo\\\\" ssh-rsa bm90aGluZw=='],
            'repeated option' => ['environment="ENV=PRODUCTION",environment="SECRET=42" ssh-ed25519 Zm9vYmFy'],
        ];
    }
}
