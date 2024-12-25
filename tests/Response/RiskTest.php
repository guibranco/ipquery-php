<?php

namespace GuiBranco\IpQuery\Tests\Response;

use PHPUnit\Framework\TestCase;
use GuiBranco\IpQuery\Response\Risk;

class RiskTest extends TestCase
{
    public function testFromArray()
    {
        $data = [
            'is_mobile' => true,
            'is_vpn' => false,
            'is_tor' => true,
            'is_proxy' => false,
            'is_datacenter' => true,
            'risk_score' => 75
        ];

        $risk = Risk::fromArray($data);

        $this->assertTrue($risk->isMobile);
        $this->assertFalse($risk->isVpn);
        $this->assertTrue($risk->isTor);
        $this->assertFalse($risk->isProxy);
        $this->assertTrue($risk->isDatacenter);
        $this->assertEquals(75, $risk->riskScore);
    }
}
