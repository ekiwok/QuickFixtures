<?php

use Ekiwok\QuickFixtures\Examples\YML\Model\Customer;

require_once(__DIR__.'/vendor/autoload.php');

$generator = (new \Ekiwok\QuickFixtures\Factory\GeneratorFactory())->create();
$data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . "/Resources/fixtures.yml"));

$customers = [];

foreach ($data as $piece) {
    $customers[] = $generator->generate(Customer::class, $piece);
}

print_r($customers);
