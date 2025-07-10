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
        $userData = new UserData()
            ->setCity($this->data['city'] ?? null)
            ->setState($this->data['state'] ?? null)
            ->setClientIpAddress($this->data['ip'] ?? null)
            ->setCountryCode($this->data['country'] ?? null)
            ->setEmail($this->data['email'] ?? null);
        
        $customData = new CustomData([
                'content_category' => $this->data['app_name'] ?? null
        ]);

        if($eventName === 'Purchase' ) {
            $customData
                ->setValue(floatval($this->data['amount'] ?? '1.00'))
                ->setCurrency($this->data['currency'] ?? 'USD');
        }

        return (new Event())
            ->setEventId($this->data['event_id'] ?? null)
            ->setEventName($eventName)
            ->setEventTime(time())
            ->setUserData($userData)
            ->setActionSource('server');
    }
}