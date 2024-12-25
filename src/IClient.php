<?php

namespace GuiBranco\IpQuery;

use GuiBranco\IpQuery\Response\IpQueryResponse;

interface IClient
{
    public function getMyIp(): IpQueryResponse;
    public function getIpData(string $ip): IpQueryResponse;
    public function getMultipleIpData(array $ips): array;
}