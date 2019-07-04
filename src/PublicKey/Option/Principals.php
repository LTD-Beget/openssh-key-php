<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionSingle;

class Principals extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'principals';
    }
}
