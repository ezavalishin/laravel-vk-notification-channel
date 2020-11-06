<?php

namespace ezavalishin\VkChatBotNotificationChannel;

use Illuminate\Contracts\Support\Arrayable;

class VkChatBotNotificationMessage implements Arrayable
{
    protected $payload = [];

    public function __construct(string $text = '')
    {
        $this->payload['random_id'] = 0;
        $this->text($text);
    }

    public function to(int $peerId): VkChatBotNotificationMessage
    {
        $this->payload['peer_id'] = $peerId;

        return $this;
    }

    public function text(string $text): VkChatBotNotificationMessage
    {
        $this->payload['message'] = $text;

        return $this;
    }

    public function toNotGiven(): bool
    {
        return !isset($this->payload['peer_id']);
    }


    public function toArray()
    {
        return $this->payload;
    }
}
