<?php

namespace LTDBeget\openssh\AuthorizedKey\Option;

use LTDBeget\openssh\AuthorizedKey\OptionNoValue;

class NoPortForwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'no-port-forwarding';
    }
}
