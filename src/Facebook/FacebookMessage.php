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
            'email' => $this->data['email'] ?? null,
        ]);

        $userData
            ->setFirstName($this->data['first_name'] ?? null)
            ->setLastName($this->data['last_name'] ?? null)
            ->setCity($this->data['city'] ?? null)
            ->setState($this->data['state'] ?? null)
            ->setClientIpAddress($this->data['ip'] ?? null)
            ->setCountryCode($this->data['country'] ?? null)
            ->setZipCode($this->data['zip_code'] ?? null)
            ->setPhone($this->data['phone'] ?? null)
            ->setClientUserAgent($this->data['user_agent'] ?? null)
            ->setFbc($this->data['fbc_id'] ?? null)
            ->setFbp($this->data['fbp_id'] ?? null);

        $customData = new CustomData([
            'content_category' => $this->data['app_name'] ?? null
        ]);

        if ($eventName === 'Purchase') {
            $customData
                ->setValue(floatval($this->data['amount'] ?? '1.00'))
                ->setCurrency($this->data['currency'] ?? 'USD');
        }

        return (new Event())
            ->setEventId($this->data['event_id'] ?? null)
            ->setEventName($eventName)
            ->setEventTime(time())
            ->setUserData($userData)
            ->setCustomData($customData)
            ->setActionSource('website');
    }
}
