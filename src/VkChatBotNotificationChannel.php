<?php

namespace ezavalishin\VkChatBotNotificationChannel;

use ezavalishin\VkChatBotNotificationChannel\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use VK\Exceptions\Api\VKApiMessagesCantFwdException;
use VK\Exceptions\Api\VKApiMessagesChatBotFeatureException;
use VK\Exceptions\Api\VKApiMessagesChatUserNoAccessException;
use VK\Exceptions\Api\VKApiMessagesContactNotFoundException;
use VK\Exceptions\Api\VKApiMessagesDenySendException;
use VK\Exceptions\Api\VKApiMessagesKeyboardInvalidException;
use VK\Exceptions\Api\VKApiMessagesPrivacyException;
use VK\Exceptions\Api\VKApiMessagesTooLongForwardsException;
use VK\Exceptions\Api\VKApiMessagesTooLongMessageException;
use VK\Exceptions\Api\VKApiMessagesTooManyPostsException;
use VK\Exceptions\Api\VKApiMessagesUserBlockedException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

class VkChatBotNotificationChannel
{
    /**
     * @var VkClient
     */
    protected $client;

    public function __construct(VkClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     * @return array|null
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification): ?array
    {
        $message = $notification->toVk($notifiable);

        if (is_string($message)) {
            $message = new VkChatBotNotificationMessage($message);
        }

        if ($message->toNotGiven()) {
            if (!$to = $notifiable->routeNotificationFor('vk', $notification)) {
                return null;
            }

            $message->to($to);
        }

        try {
            return $this->client->sendMessage($message->toArray());
        } catch (\Exception $e) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($e->getMessage());
        }
    }
}
