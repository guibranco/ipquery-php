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

    public function testFromArray()
    {
        $data = [
            [
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
            ],
            [
                'ip' => '192.168.1.2',
                'isp' => [
                    'org' => 'Another ISP',
                    'asn' => '67890'
                ],
                'location' => [
                    'country' => 'Another Country',
                    'city' => 'Another City'
                ],
                'risk' => [
                    'risk_score' => 2
                ]
            ]
        ];

        $responses = IpQueryResponse::fromArray($data);

        $this->assertCount(2, $responses);

        $this->assertInstanceOf(IpQueryResponse::class, $responses[0]);
        $this->assertEquals('192.168.1.1', $responses[0]->ip);
        $this->assertInstanceOf(Isp::class, $responses[0]->isp);
        $this->assertEquals('Test ISP', $responses[0]->isp->org);
        $this->assertEquals('12345', $responses[0]->isp->asn);
        $this->assertInstanceOf(Location::class, $responses[0]->location);
        $this->assertEquals('Test Country', $responses[0]->location->country);
        $this->assertEquals('Test City', $responses[0]->location->city);
        $this->assertInstanceOf(Risk::class, $responses[0]->risk);
        $this->assertEquals(1, $responses[0]->risk->riskScore);

        $this->assertInstanceOf(IpQueryResponse::class, $responses[1]);
        $this->assertEquals('192.168.1.2', $responses[1]->ip);
        $this->assertInstanceOf(Isp::class, $responses[1]->isp);
        $this->assertEquals('Another ISP', $responses[1]->isp->org);
        $this->assertEquals('67890', $responses[1]->isp->asn);
        $this->assertInstanceOf(Location::class, $responses[1]->location);
        $this->assertEquals('Another Country', $responses[1]->location->country);
        $this->assertEquals('Another City', $responses[1]->location->city);
        $this->assertInstanceOf(Risk::class, $responses[1]->risk);
        $this->assertEquals(2, $responses[1]->risk->riskScore);
    }
}
