<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionSingle;

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
