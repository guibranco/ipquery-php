<?php

namespace GuiBranco\IpQuery\Response;

class IpQueryResponse
{
    public string $ip;
    public ?Isp $isp;
    public ?Location $location;
    public ?Risk $risk;

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);

        $response = new self();
        $response->ip = $data['ip'];
        $response->isp = isset($data['isp']) && is_array($data['isp']) ? Isp::fromArray($data['isp']) : null;
        $response->location = isset($data['location']) && is_array($data['location']) ? Location::fromArray($data['location']) : null;
        $response->risk = isset($data['risk']) && is_array($data['risk']) ? Risk::fromArray($data['risk']) : null;

        return $response;
    }
}
