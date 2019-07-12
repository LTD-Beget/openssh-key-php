<?php

namespace OpenSSH\AuthorizedKey\Option;

use OpenSSH\AuthorizedKey\OptionNoValue;

class AgentForwarding extends OptionNoValue
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'agent-forwarding';
    }
}
