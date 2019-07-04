<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

class Restrict extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'restrict';
    }
}
