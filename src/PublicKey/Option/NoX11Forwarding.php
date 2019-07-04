<?php

namespace OpenSSH\PublicKey\Option;

use OpenSSH\PublicKey\OptionNoValue;

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
