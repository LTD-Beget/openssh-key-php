<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class NoX11Forwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'no-X11-forwarding';
    }
}
