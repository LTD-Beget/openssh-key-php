<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

class Pty extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'pty';
    }
}
