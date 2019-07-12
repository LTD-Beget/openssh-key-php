<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class PortForwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'port-forwarding';
    }
}
