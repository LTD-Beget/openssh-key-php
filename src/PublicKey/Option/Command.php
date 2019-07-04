<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionSingle;

class Command extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'command';
    }
}
