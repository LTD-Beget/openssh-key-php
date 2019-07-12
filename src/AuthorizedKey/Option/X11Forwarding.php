<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class X11Forwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'X11-forwarding';
    }
}
