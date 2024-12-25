<?php

namespace GuiBranco\IpQuery;

use GuiBranco\IpQuery\Response\IpQueryResponse;

interface IIpQueryClient
{
    public function getMyIpData(): IpQueryResponse;
    public function getIpData(string $ip): IpQueryResponse;
    public function getMultipleIpData(array $ips): array;
}
