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
        $customData = new CustomData([
            'content_category' => $this->data['skin'] ?? null,
        ]);

        $userData = new UserData([
            'email'        => $this->data['email'] ?? null,
            'country_code' => $this->data['realIpCountry'] ?? null,
            'external_id'  => $this->data['externalUserId'] ?? null,
            'first_name'   => $this->data['userName'] ?? null,
            'phone'        => $this->data['mobile'] ?? null,
        ]);

        return (new Event())
            ->setEventName($eventName)
            ->setEventTime(time())
            ->setUserData($userData)
            ->setCustomData($customData)
            ->setActionSource('website');
    }
}