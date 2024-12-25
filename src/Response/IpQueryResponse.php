<?php

namespace GuiBranco\IpQuery\Response;

class IpQueryResponse
{
    public ?string $ip;
    public ?Isp $isp;
    public ?Location $location;
    public ?Risk $risk;

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        return self::fromArray($data);
    }

    public static function fromArray(array $data): self
    {
        $response = new self();
        $response->ip = $data['ip'] ?? null;
        $response->isp = isset($data['isp']) && is_array($data['isp']) ? Isp::fromArray($data['isp']) : null;
        $response->location = isset($data['location']) && is_array($data['location']) ? Location::fromArray($data['location']) : null;
        $response->risk = isset($data['risk']) && is_array($data['risk']) ? Risk::fromArray($data['risk']) : null;

        return $response;
    }
}
