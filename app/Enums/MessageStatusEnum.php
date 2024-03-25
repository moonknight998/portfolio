<?php

namespace App\Enums;

enum MessageStatusEnum: string
{
    case SENT = 'sent';
    case RECEIVED = 'received';
    case SEEN = 'seen';

    public function label(): string
    {
        return match ($this) {
            self::SENT => __('admin/common.sent'),
            self::RECEIVED => __('admin/common.received'),
            self::SEEN => __('admin/common.seen'),
        };
    }

    // public function description(): string
    // {
    //     return match ($this) {
    //         self::SENT => 'Message sent',
    //         self::RECEIVED => 'Message received',
    //         self::SEEN => 'Message seen',
    //     };
    // }

}