<?php

namespace LTDBeget\openssh\PublicKey;

use MabeEnum\Enum;

/**
 * @method static Type ECDSA_SHA2_NISTP256()
 * @method static Type ECDSA_SHA2_NISTP384()
 * @method static Type ECDSA_SHA2_NISTP521()
 * @method static Type SSH_ED25519()
 * @method static Type SSH_DSS()
 * @method static Type SSH_RSA()
 *
 * @method string getValue()
 */
class Type extends Enum
{
    public const ECDSA_SHA2_NISTP256 = 'ecdsa-sha2-nistp256';
    public const ECDSA_SHA2_NISTP384 = 'ecdsa-sha2-nistp384';
    public const ECDSA_SHA2_NISTP521 = 'ecdsa-sha2-nistp521';
    public const SSH_ED25519         = 'ssh-ed25519';
    public const SSH_DSS             = 'ssh-dss';
    public const SSH_RSA             = 'ssh-rsa';
}
