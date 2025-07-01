<?php

namespace SocialCAPI\Facebook;

use FacebookAds\Api;
use FacebookAds\Object\ServerSide\EventRequest;
use Illuminate\Contracts\Config\Repository as Config;

class FacebookChannel
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function send(array $notifiable): bool
    {
        $message = new FacebookMessage($notifiable);

        Api::init(null, null, $this->config->get('fb-capi.access_token'));

        $event = $message->getEvent($notifiable['event_name']);

        $request = (new EventRequest($this->config->get('fb-capi.pixel_id')))
            ->setEvents([$event]);

        if (!empty($notifiable['test_event_code'])) {
            $request->setTestEventCode($notifiable['test_event_code']);
        } 
           
        $request->execute();

        return true;
    }
}