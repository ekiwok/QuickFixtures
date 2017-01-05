<?php

use Ekiwok\QuickFixtures\Examples\YML\Model\Customer;

require_once(__DIR__.'/vendor/autoload.php');

try {
    $data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . "/Resources/fixtures.yml"));
} catch (\Symfony\Component\Yaml\Exception\ParseException $e) {
    exit($e->getMessage());
}

$generator = (new \Ekiwok\QuickFixtures\Factory\GeneratorFactory())->create();

$customers = [];

foreach ($data as $piece) {
    $customer = $generator->generate(Customer::class, $piece);
}

print_r($customers);
