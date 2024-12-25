<?php

namespace GuiBranco\IpQuery\Tests\Response;

use PHPUnit\Framework\TestCase;
use GuiBranco\IpQuery\Response\IpQueryResponse;
use GuiBranco\IpQuery\Response\Isp;
use GuiBranco\IpQuery\Response\Location;
use GuiBranco\IpQuery\Response\Risk;

class IpQueryResponseTest extends TestCase
{
    public function testFromJson()
    {
        $json = json_encode([
            'ip' => '192.168.1.1',
            'isp' => [
                'org' => 'Test ISP',
                'asn' => '12345'
            ],
            'location' => [
                'country' => 'Test Country',
                'city' => 'Test City'
            ],
            'risk' => [
                'risk_score' => 1
            ]
        ]);

        $response = IpQueryResponse::fromJson($json);

        $this->assertInstanceOf(IpQueryResponse::class, $response);
        $this->assertEquals('192.168.1.1', $response->ip);
        $this->assertInstanceOf(Isp::class, $response->isp);
        $this->assertEquals('Test ISP', $response->isp->org);
        $this->assertEquals('12345', $response->isp->asn);
        $this->assertInstanceOf(Location::class, $response->location);
        $this->assertEquals('Test Country', $response->location->country);
        $this->assertEquals('Test City', $response->location->city);
        $this->assertInstanceOf(Risk::class, $response->risk);
        $this->assertEquals(1, $response->risk->riskScore);
    }
}