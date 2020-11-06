<?php

namespace ezavalishin\VkChatBotNotificationChannel;

use VK\Client\VKApiClient;
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

class VkClient
{
    /**
     * @var VKApiClient
     */
    protected $client;

    /**
     * @var string|null
     */
    protected $accessToken;

    public function __construct($accessToken = null, $apiVersion = '5.124', $lang = 'ru') {
        $this->accessToken = $accessToken;
        $this->client = new VKApiClient($apiVersion, $lang);
    }

    /**
     * @param $payload
     * @return mixed
     * @throws VKApiMessagesCantFwdException
     * @throws VKApiMessagesChatBotFeatureException
     * @throws VKApiMessagesChatUserNoAccessException
     * @throws VKApiMessagesContactNotFoundException
     * @throws VKApiMessagesDenySendException
     * @throws VKApiMessagesKeyboardInvalidException
     * @throws VKApiMessagesPrivacyException
     * @throws VKApiMessagesTooLongForwardsException
     * @throws VKApiMessagesTooLongMessageException
     * @throws VKApiMessagesTooManyPostsException
     * @throws VKApiMessagesUserBlockedException
     * @throws VKApiException
     * @throws VKClientException
     */
    public function sendMessage(array $payload) {
        return $this->client->messages()->send($this->accessToken, $payload);
    }
}
