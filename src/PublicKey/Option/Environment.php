<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionRepeated;

class Environment extends OptionRepeated
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'environment';
    }
}
