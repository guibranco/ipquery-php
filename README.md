# 🌐📍 IpQuery API Client for PHP

A lightweight and efficient PHP library for querying IP data from the [IpQuery API](https://ipquery.io/). Easily retrieve detailed information about IP addresses, including ISP details, geolocation, and risk analysis. Supports multiple formats (JSON, XML, YAML, and plain text) and batch IP queries.

---

## Features

- Retrieve your public IP information.
- Query detailed data for a single or multiple IP addresses.
- Parse responses into strongly-typed PHP objects.
- Supports multiple response formats (JSON, XML, YAML, and plain text).
- Simple integration with pure PHP using cURL.

---

## Installation

You can install the library using Composer:

```bash
composer require guibranco/ipquery-php
```

---

## Usage

### Get your public IP data

```php
require_once 'vendor/autoload.php';

use GuiBranco\IpQuery\Client;

$client = new Client();

try {
    $ipQuery = $client->getMyIpData();
    echo "My IP: {$ipQuery->ip}" . PHP_EOL;
    echo "ISP: {$ipQuery->isp->org}" . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
```

### Get data for a specific IP

```php
$ipData = $client->getIpData('8.8.8.8');
echo "IP: {$ipData->ip}" . PHP_EOL;
echo "Location: {$ipData->location->city}, {$ipData->location->country}" . PHP_EOL;
```

### Get data for multiple IPs

```php
$multipleIpData = $client->getMultipleIpData(['8.8.8.8', '8.8.4.4']);
foreach ($multipleIpData as $ip) {
    echo "IP: {$ip->ip}, Org: {$ip->isp->org}" . PHP_EOL;
}
```

---

## Response Mapping

The library parses JSON responses into the following class structure:

### IpResponse

```php
class IpResponse {
    public string $ip;
    public Isp $isp;
    public Location $location;
    public Risk $risk;
}
```

### Isp

```php
class Isp {
    public string $asn;
    public string $org;
    public string $isp;
}
```

### Location

```php
class Location {
    public string $country;
    public string $country_code;
    public string $city;
    public string $state;
    public string $zipcode;
    public float $latitude;
    public float $longitude;
    public string $timezone;
    public string $localtime;
}
```

### Risk

```php
class Risk {
    public bool $is_mobile;
    public bool $is_vpn;
    public bool $is_tor;
    public bool $is_proxy;
    public bool $is_datacenter;
    public int $risk_score;
}
```

---

## Requirements

- PHP 7.4+
- cURL extension enabled

---

## License

This project is licensed under the [MIT License](LICENSE).

---

## Contribution

Contributions are welcome! Feel free to open issues or submit pull requests to improve the library.

---

## Examples

See the [examples/](examples/) directory for more code examples.
