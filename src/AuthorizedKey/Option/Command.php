<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionSingle;

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
