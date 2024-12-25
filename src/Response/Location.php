<?php

namespace GuiBranco\IpQuery\Response;

class Location
{
    public ?string $country;
    public ?string $countryCode;
    public ?string $city;
    public ?string $state;
    public ?string $zipcode;
    public float $latitude;
    public float $longitude;
    public ?string $timezone;
    public ?string $localtime;

    public static function fromArray(array $data): self
    {
        $location = new self();
        $location->country = isset($data['country']) && is_string($data['country']) ? $data['country'] : null;
        $location->countryCode = isset($data['country_code']) && is_string($data['country_code']) ? $data['country_code'] : null;
        $location->city = isset($data['city']) && is_string($data['city']) ? $data['city'] : null;
        $location->state = isset($data['state']) && is_string($data['state']) ? $data['state'] : null;
        $location->zipcode = isset($data['zipcode']) && is_string($data['zipcode']) ? $data['zipcode'] : null;
        $location->latitude = isset($data['latitude']) && is_float($data['latitude']) ? $data['latitude'] : 0.0;
        $location->longitude = isset($data['longitude']) && is_float($data['longitude']) ? $data['longitude'] : 0.0;
        $location->timezone = isset($data['timezone']) && is_string($data['timezone']) ? $data['timezone'] : null;
        $location->localtime = isset($data['localtime']) && is_string($data['localtime']) ? $data['localtime'] : null;

        return $location;
    }
}
