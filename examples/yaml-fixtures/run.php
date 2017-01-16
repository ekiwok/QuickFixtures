<?php

use Ekiwok\QuickFixtures\Examples\YML\Model\Customer;

require_once(__DIR__.'/vendor/autoload.php');

$data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . "/Resources/fixtures.yml"));

$generator = (new \Ekiwok\QuickFixtures\Factory\GeneratorFactory())->create();
$generator->addProcessor(new \Ekiwok\QuickFixtures\Examples\YML\Processor\DateTimeProcessor());
$generator->addProcessor(new \Ekiwok\QuickFixtures\Examples\YML\Processor\SillyPasswordProcessor());

$customers = [];

foreach ($data as $piece) {
    $customers[] = $generator->generate(Customer::class, $piece);
}

print_r($customers);
