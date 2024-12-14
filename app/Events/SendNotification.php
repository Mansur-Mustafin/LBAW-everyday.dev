<?php

namespace App\Events;

use App\Enums\NotificationTypeEnum;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Notification $notification;

    public function __construct(Notification $notification)
    {
        switch ($notification->notification_type) {
            case NotificationTypeEnum::VOTE->value:
                $notification->load(['vote.user.profileImage']);
                break;
            case NotificationTypeEnum::COMMENT->value:
                $notification->load(['comment.author.profileImage']);
                break;
            case NotificationTypeEnum::FOLLOW->value:
                $notification->load(['follower.profileImage']);
                break;
            case NotificationTypeEnum::POST->value:
                $notification->load(['newsPost.author.profileImage']);
                break;
        }

        $this->notification = $notification;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('user.' . $this->notification->user_id),
        ];
    }

    public function broadcastAs()
    {
        return 'notification-personal';
    }

    public function broadcastWith()
    {
        $payload = [
            'notification_type' => $this->notification->notification_type,
            'id' => $this->notification->id,
        ];

        switch ($this->notification->notification_type) {
            case NotificationTypeEnum::VOTE->value:
                $payload['vote'] = [
                    'id' => $this->notification->vote_id,
                    'is_upvote' => $this->notification->vote->is_upvote,
                    'news_post_id' => $this->notification->vote->news_post_id,
                    'user' => [
                        'id' => $this->notification->vote->user->id,
                        'public_name' => $this->notification->vote->user->public_name,
                        'profile_image' => $this->notification->vote->user->profileImage->url,
                    ],
                ];
                break;
            case NotificationTypeEnum::COMMENT->value:
                $payload['comment'] = [
                    'id' => $this->notification->comment_id,
                    'content' => $this->notification->comment->content,
                    'news_post_id' => $this->notification->comment->news_post_id,
                    'author' => [
                        'id' => $this->notification->comment->author->id,
                        'public_name' => $this->notification->comment->author->public_name,
                        'profile_image' => $this->notification->comment->author->profileImage->url,
                    ],
                ];
                break;
            case NotificationTypeEnum::FOLLOW->value:
                $payload['follower'] = [
                    'id' => $this->notification->follower_id,
                    'public_name' => $this->notification->follower->public_name,
                    'profile_image' => $this->notification->follower->profileImage->url,
                ];
                break;
            case NotificationTypeEnum::POST->value:
                $payload['news_post'] = [
                    'id' => $this->notification->news_post_id,
                    'title' => $this->notification->newsPost->title,
                    'author' => [
                        'id' => $this->notification->newsPost->author->id,
                        'public_name' => $this->notification->newsPost->author->public_name,
                        'profile_image' => $this->notification->newsPost->author->profileImage->url,
                    ],
                ];
                break;
        }

        return $payload;
    }
}
