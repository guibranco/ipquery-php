<?php

namespace GuiBranco\IpQuery;

use GuiBranco\IpQuery\Response\IpQueryResponse;
use GuiBranco\IpQuery\IpQueryException;

class IpQueryClient implements IIpQueryClient
{
    private string $baseUrl = 'https://api.ipquery.io';

    public function getMyIpData(): IpQueryResponse
    {
        $response = $this->makeRequest('/');
        return IpQueryResponse::fromJson($response);
    }

    public function getIpData(string $ip): IpQueryResponse
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new IpQueryException(400, 'Invalid IP address format.');
        }

        $response = $this->makeRequest("/{$ip}");
        return IpQueryResponse::fromJson($response);
    }

    public function getMultipleIpData(array $ips): array
    {

        if (empty($ips)) {
            throw new IpQueryException(400, 'Empty IP list');
        }

        $ipList = implode(',', $ips);
        $response = $this->makeRequest("/{$ipList}");

        $decoded = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        return array_map(
            fn ($ipData) => IpQueryResponse::fromArray($ipData),
            $decoded
        );
    }

    protected function makeRequest(string $endpoint): string
    {
        $url = $this->baseUrl . $endpoint . '?format=json';
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);

        curl_setopt($curl, CURLOPT_USERAGENT, 'IpQuery PHP Client/1.0 (+https://github.com/guibranco/ipquery-php)');

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false || $httpCode !== 200) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new IpQueryException($httpCode, $error);
        }

        curl_close($curl);
        return $response;
    }
}
