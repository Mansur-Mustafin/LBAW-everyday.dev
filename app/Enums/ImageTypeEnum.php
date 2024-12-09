<?php

namespace App\Enums;

enum ImageTypeEnum: string
{
    case PROFILE = 'Profile';
    case POST_TITLE = 'PostTitle';
    case POST_CONTENT = 'PostContent';

    public function label(): string
    {
        return match ($this) {
            self::PROFILE => 'profile/default.svg',
            self::POST_TITLE => 'post/default-post-title-image.jpg',
            self::POST_CONTENT => 'post/default-post-content-image.jpg',
        };
    }
}
