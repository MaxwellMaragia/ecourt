<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Notification;
use NotificationChannels\AfricasTalking\AfricasTalkingChannel;
use NotificationChannels\AfricasTalking\AfricasTalkingMessage;

class SendNotification extends Notification
{
    //
    public function via($notifiable)
    {
        return [AfricasTalkingChannel::class];
    }

    public function toAfricasTalking($notifiable)
    {
        return (new AfricasTalkingMessage())
            ->content('Your SMS message content');

    }
}
