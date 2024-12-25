<?php

namespace GuiBranco\IpQuery;

class IpQueryException extends \Exception
{
    public function __construct(int $httpCode, string $error)
    {
        parent::__construct("Request failed with HTTP code $httpCode. Error: $error");
    }
}
