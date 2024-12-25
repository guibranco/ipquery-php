<?php

namespace GuiBranco\IpQuery\Tests\Response;

use PHPUnit\Framework\TestCase;
use GuiBranco\IpQuery\Response\Location;

class LocationTest extends TestCase
{
    public function testFromArray()
    {
        $data = [
            'country' => 'United States',
            'country_code' => 'US',
            'city' => 'New York',
            'state' => 'NY',
            'zipcode' => '10001',
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            'timezone' => 'America/New_York',
            'localtime' => '2023-10-01 12:00:00'
        ];

        $location = Location::fromArray($data);

        $this->assertEquals('United States', $location->country);
        $this->assertEquals('US', $location->countryCode);
        $this->assertEquals('New York', $location->city);
        $this->assertEquals('NY', $location->state);
        $this->assertEquals('10001', $location->zipcode);
        $this->assertEquals(40.7128, $location->latitude);
        $this->assertEquals(-74.0060, $location->longitude);
        $this->assertEquals('America/New_York', $location->timezone);
        $this->assertEquals('2023-10-01 12:00:00', $location->localtime);
    }
}
