<?php
declare(strict_types=1);

namespace Sms77\Tests;
require_once '../vendor/autoload.php';

use Sms77\Api\Client;

$apiKey = getenv("SMS77_API_KEY");
$api = new Client($apiKey);
$recipient = getenv("SMS77_RECIPIENT");
$text = "TEST " . time();
$response = $api->sms($recipient, $text, ["no_reload" => 1]);

print_r($response);

$successCode = 100;
assert($successCode == $response, "Expected response to match success code $successCode.");