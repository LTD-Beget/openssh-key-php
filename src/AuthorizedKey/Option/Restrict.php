<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

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
