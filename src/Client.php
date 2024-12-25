<?php

namespace GuiBranco\IpQuery;

use GuiBranco\IpQuery\Response\IpQueryResponse;
use GuiBranco\IpQuery\IpQueryException;

class Client implements IClient
{
    private string $baseUrl = 'https://api.ipquery.io';

    public function getMyIp(): IpQueryResponse
    {
        $response = $this->makeRequest('/');
        return IpQueryResponse::fromJson($response);
    }

    public function getIpData(string $ip): IpQueryResponse
    {
        $response = $this->makeRequest("/{$ip}");
        return IpQueryResponse::fromJson($response);
    }

    public function getMultipleIpData(array $ips): array
    {
        $ipList = implode(',', $ips);
        $response = $this->makeRequest("/{$ipList}");

        $decoded = json_decode($response, true);
        return array_map(
            fn($ipData) => IpQueryResponse::fromJson(json_encode($ipData)),
            $decoded
        );
    }

    protected function makeRequest(string $endpoint): string
    {
        $url = $this->baseUrl . $endpoint . '?format=json';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  // 5 second connection timeout
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);        // 30 second timeout for the whole request

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($response === false || $httpCode !== 200) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new IpQueryException($httpCode, $error);
        }

        curl_close($ch);
        return $response;
    }
}
