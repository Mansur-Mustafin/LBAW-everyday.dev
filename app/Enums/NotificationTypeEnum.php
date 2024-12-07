<?php

namespace App\Enums;

enum NotificationTypeEnum: string
{
    case VOTE = 'VoteNotification';
    case COMMENT = 'CommentNotification';
    case POST = 'PostNotification';
    case FOLLOW = 'FollowNotification';
}
