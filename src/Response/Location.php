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
        
        // Helper function to safely get string values
        $getString = static function (array $data, string $key): ?string {
            return isset($data[$key]) && (is_string($data[$key]) || is_numeric($data[$key])) 
                ? (string) $data[$key] 
                : null;
        };
        
        // Helper function to safely get float values
        $getFloat = static function (array $data, string $key): ?float {
            if (!isset($data[$key])) {
                return null;
            }
            return is_numeric($data[$key]) ? (float) $data[$key] : null;
        };
        
        // Map string fields
        $stringFields = ['country', 'country_code', 'city', 'state', 'zipcode', 'timezone', 'localtime'];
        foreach ($stringFields as $field) {
            $property = str_replace('_', '', $field); // Handle special case for country_code
            $location->$property = $getString($data, $field);
        }
        
        // Map coordinate fields
        $location->latitude = $getFloat($data, 'latitude');
        $location->longitude = $getFloat($data, 'longitude');
        
        return $location;
    }
}
