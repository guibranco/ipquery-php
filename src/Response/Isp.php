<?php

namespace GuiBranco\IpQuery\Response;

class Isp
{
    public ?string $asn;
    public ?string $org;
    public ?string $isp;

    public static function fromArray(array $data): self
    {
        $isp = new self();
        $isp->asn = isset($data['asn']) && !empty($data['asn']) ? $data['asn'] : null;
        $isp->org = isset($data['org']) && !empty($data['org']) ? $data['org'] : null;
        $isp->isp = isset($data['isp']) && !empty($data['isp']) ? $data['isp'] : null;

        return $isp;
    }
}
