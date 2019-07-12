<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionSingle;

class From extends OptionSingle
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'from';
    }
}
