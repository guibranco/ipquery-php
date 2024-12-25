<?php

namespace GuiBranco\IpQuery\Tests;

use PHPUnit\Framework\TestCase;
use GuiBranco\IpQuery\Client;
use GuiBranco\IpQuery\Response\IpQueryResponse;
use GuiBranco\IpQuery\IpQueryException;

class ClientTest extends TestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = new Client();
    }

    public function testGetMyIpData()
    {
        $response = $this->createMock(IpQueryResponse::class);
        $this->client = $this->getMockBuilder(Client::class)
            ->onlyMethods(['makeRequest'])
            ->getMock();

        $this->client->expects($this->once())
            ->method('makeRequest')
            ->with('/')
            ->willReturn('{"ip":"127.0.0.1"}');

        $result = $this->client->getMyIpData();
        $this->assertInstanceOf(IpQueryResponse::class, $result);
    }

    public function testGetIpData()
    {
        $response = $this->createMock(IpQueryResponse::class);
        $this->client = $this->getMockBuilder(Client::class)
            ->onlyMethods(['makeRequest'])
            ->getMock();

        $this->client->expects($this->once())
            ->method('makeRequest')
            ->with('/127.0.0.1')
            ->willReturn('{"ip":"127.0.0.1", "isp":{}, "location":{}, "risk":{}}');

        $result = $this->client->getIpData('127.0.0.1');
        $this->assertInstanceOf(IpQueryResponse::class, $result);
    }

    public function testGetIpDataThrowsExceptionOnInvalidIp()
    {
        $this->expectException(IpQueryException::class);
        $this->expectExceptionMessage('Invalid IP address format.');
        $this->client->getIpData('invalid-ip');
    }

    public function testGetMultipleIpData()
    {
        $response = $this->createMock(IpQueryResponse::class);
        $this->client = $this->getMockBuilder(Client::class)
            ->onlyMethods(['makeRequest'])
            ->getMock();

        $this->client->expects($this->once())
            ->method('makeRequest')
            ->with('/127.0.0.1,192.168.0.1')
            ->willReturn('[{"ip":"127.0.0.1"},{"ip":"192.168.0.1"}]');

        $result = $this->client->getMultipleIpData(['127.0.0.1', '192.168.0.1']);
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(IpQueryResponse::class, $result[0]);
        $this->assertInstanceOf(IpQueryResponse::class, $result[1]);
    }

    public function testGetMultipleIpDataThrowsExceptionOnEmptyList()
    {
        $this->expectException(IpQueryException::class);
        $this->expectExceptionMessage('Empty IP list');
        $this->client->getMultipleIpData([]);
    }

    public function testMakeRequestThrowsExceptionOnError()
    {
        $this->client = $this->getMockBuilder(Client::class)
            ->onlyMethods(['makeRequest'])
            ->getMock();

        $this->client->expects($this->once())
            ->method('makeRequest')
            ->with('/127.0.0.0')
            ->will($this->throwException(new IpQueryException(404, 'Not Found')));

        $this->expectException(IpQueryException::class);
        $this->client->getIpData('127.0.0.0');
    }
}
