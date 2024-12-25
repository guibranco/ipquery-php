<?php

namespace GuiBranco\IpQuery\Response;

class Risk
{
    public ?bool $isMobile;
    public ?bool $isVpn;
    public ?bool $isTor;
    public ?bool $isProxy;
    public ?bool $isDatacenter;
    public ?int $riskScore;

    public static function fromArray(array $data): self
    {
        $risk = new self();
        $risk->isMobile = $data['is_mobile'] ?? null;
        $risk->isVpn = $data['is_vpn'] ?? null;
        $risk->isTor = $data['is_tor'] ?? null;
        $risk->isProxy = $data['is_proxy'] ?? null;
        $risk->isDatacenter = $data['is_datacenter'] ?? null;
        $risk->riskScore = $data['risk_score'] ?? null;

        return $risk;
    }
}
