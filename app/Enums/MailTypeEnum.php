<?php

namespace App\Enums;

enum MailTypeEnum: string
{
    case RECOVER = 'recover-password';
    case PROFILE_UPDATE = 'profile-update';
}
