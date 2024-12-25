<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GuiBranco\IpQuery\Client;

$client = new Client();

try {
    // Get my IP data
    $myIpData = $client->getMyIpData();
    echo "My IP: {$myIpData->ip}" . PHP_EOL;
    echo "ISP: {$myIpData->isp->org}" . PHP_EOL;

    // Get specific IP data
    $ipData = $client->getIpData('8.8.8.8');
    echo "IP: {$ipData->ip}" . PHP_EOL;
    echo "Location: {$ipData->location->city}, {$ipData->location->country}" . PHP_EOL;

    // Get multiple IP data
    $multipleIpData = $client->getMultipleIpData(['8.8.8.8', '8.8.4.4']);
    foreach ($multipleIpData as $ip) {
        echo "IP: {$ip->ip}, Org: {$ip->isp->org}" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
