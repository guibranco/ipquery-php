# 🌐📍 IpQuery API Client for PHP

A lightweight and efficient PHP library for querying IP data from the [IpQuery API](https://ipquery.io/).  
Easily retrieve detailed information about IP addresses, including ISP details, geolocation, and risk analysis.

[![Packagist Downloads](https://img.shields.io/packagist/dt/guibranco/ipquery-php)](https://packagist.org/packages/guibranco/ipquery-php)
[![GitHub Downloads](https://img.shields.io/github/downloads/guibranco/ipquery-php/total)](https://github.com/guibranco/ipquery-php/releases)

---

## Features ✨

- Retrieve your public IP information with ease.
- Query detailed data for single or multiple IP addresses.
- Parse JSON responses into strongly-typed PHP objects.
- Simple integration using pure PHP and cURL.

---

## Installation 📦

You can install the library using Composer:

```bash
composer require guibranco/ipquery-php
```

---

## Usage 🚀

### Get your public IP data

```php
require_once 'vendor/autoload.php';

use GuiBranco\IpQuery\IpQueryClient;

$client = new IpQueryClient();

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

## Response Mapping 🗺️

The library parses JSON responses into the following class structure:

### IpQueryResponse

```php
class IpQueryResponse {
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

## Requirements 🛠️

- PHP 8.2 or newer
- cURL extension enabled

---

## Running Tests 🧪

This project uses [PhpUnit 11](https://phpunit.de/) for unit tests. To run the tests, execute:

```bash
./vendor/bin/phpunit
```

---

## Contribution 🤝

Contributions are welcome! Please read the [CONTRIBUTING.md](https://github.com/guibranco/ipquery-php/blob/main/CONTRIBUTING.md) file for details on the process.  
Feel free to open issues or submit pull requests to improve the library.

---

## License 📜

This project is licensed under the [MIT License](LICENSE).

---

## Examples 📚

Explore the [examples/](https://github.com/guibranco/ipquery-php/tree/main/examples/) directory for more code samples and ideas.
## Code Scanning Tools Integration

This repository integrates with several code scanning tools to ensure code quality.
Recommended tools include SonarCloud, SonarQube, CodeQL, and Semgrep.
Please refer to the respective documentation for configuration details.
