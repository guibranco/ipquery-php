<?php

namespace GuiBranco\IpQuery\Tests\Response;

use GuiBranco\IpQuery\Response\Isp;
use PHPUnit\Framework\TestCase;

class IspTest extends TestCase
{
    public function testFromArray()
    {
        $data = [
            'asn' => 'AS12345',
            'org' => 'Example Organization',
            'isp' => 'Example ISP'
        ];

        $isp = Isp::fromArray($data);

        $this->assertInstanceOf(Isp::class, $isp);
        $this->assertEquals('AS12345', $isp->asn);
        $this->assertEquals('Example Organization', $isp->org);
        $this->assertEquals('Example ISP', $isp->isp);
    }
}
