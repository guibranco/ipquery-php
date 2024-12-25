<?php

namespace GuiBranco\IpQuery\Tests;

use PHPUnit\Framework\TestCase;
use GuiBranco\IpQuery\IpQueryException;

class IpQueryExceptionTest extends TestCase
{
    public function testExceptionMessage()
    {
        $httpCode = 404;
        $error = "Not Found";
        $exception = new IpQueryException($httpCode, $error);

        $this->assertEquals(
            "Request failed with HTTP code 404. Error: Not Found",
            $exception->getMessage()
        );
    }

    public function testExceptionIsInstanceOfException()
    {
        $exception = new IpQueryException(500, "Internal Server Error");

        $this->assertInstanceOf(\Exception::class, $exception);
    }
}