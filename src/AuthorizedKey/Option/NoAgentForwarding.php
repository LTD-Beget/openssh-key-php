<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class NoAgentForwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'no-agent-forwarding';
    }
}
