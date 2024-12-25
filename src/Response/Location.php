<?php

namespace GuiBranco\IpQuery\Response;

class Location
{
    public ?string $country;
    public ?string $countryCode;
    public ?string $city;
    public ?string $state;
    public ?string $zipcode;
    public ?float $latitude;
    public ?float $longitude;
    public ?string $timezone;
    public ?string $localtime;

    /**
     * Create a Location instance from an array of data
     *
     * @param array $data Raw location data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $location = new self();

        $jsonToCamelCase = static function (string $key): string {
            $key = strtolower($key);
            $key = preg_replace_callback('/_([a-z])/', function ($matches) {
                return strtoupper($matches[1]);
            }, $key);

            return $key;
        };

        $getString = static function (array $data, string $key): ?string {
            return isset($data[$key]) && (is_string($data[$key]) || is_numeric($data[$key]))
                ? (string) $data[$key]
                : null;
        };

        $getFloat = static function (array $data, string $key): ?float {
            if (!isset($data[$key])) {
                return null;
            }
            return is_numeric($data[$key]) ? (float) $data[$key] : null;
        };

        $stringFields = ['country', 'country_code', 'city', 'state', 'zipcode', 'timezone', 'localtime'];
        foreach ($stringFields as $field) {
            $property = $jsonToCamelCase($field);
            $location->$property = $getString($data, $field);
        }

        $location->latitude = $getFloat($data, 'latitude');
        $location->longitude = $getFloat($data, 'longitude');

        return $location;
    }
}
