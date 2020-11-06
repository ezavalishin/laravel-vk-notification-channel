<?php

namespace ezavalishin\VkChatBotNotificationChannel;

use Illuminate\Support\ServiceProvider;

class VkChatBotNotificationChannelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->when(VkChatBotNotificationChannel::class)
            ->needs(VkClient::class)
            ->give(static function () {
                return new VkClient(
                    config('services.vk.group_service_key'),
                );
            });
    }
}
