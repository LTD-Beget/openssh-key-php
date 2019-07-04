<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

class NoPty extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'no-pty';
    }
}
