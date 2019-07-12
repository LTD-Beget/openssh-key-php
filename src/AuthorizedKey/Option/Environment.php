<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionRepeated;

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
