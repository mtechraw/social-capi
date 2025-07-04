<?php

namespace SocialCAPI\Facebook;

use FacebookAds\Object\ServerSide\{CustomData, Event, UserData};

class FacebookMessage
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getEvent(string $eventName): Event
    {
        $userData = new UserData([
            'email'             => $this->data['email'] ?? null,
            'country_code'      => $this->data['country'] ?? null,
            'state'             => $this->data['state'] ?? null,
            'city'              => $this->data['city'] ?? null,
            'client_ip_address' => $this->data['ip'] ?? null,
        ]);

        return (new Event())
            ->setEventId($this->data['event_id'] ?? null)
            ->setEventName($eventName)
            ->setEventTime(time())
            ->setUserData($userData)
            ->setActionSource('website');
    }
}