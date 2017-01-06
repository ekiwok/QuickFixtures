<?php

use Ekiwok\QuickFixtures\Examples\PropertyPath\Model\Order;

require_once(__DIR__.'/vendor/autoload.php');

$generator = (new \Ekiwok\QuickFixtures\Factory\GeneratorFactory())->create();
$data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(__DIR__ . "/Resources/fixtures.yml"))['order1'];

$generator->addProcessor(new class implements \Ekiwok\QuickFixtures\Processor\PrioritisedProcessorInterface{

    public function getPriority()
    {
        return 1025;
    }

    public function process(\Ekiwok\QuickFixtures\ContextInterface $context, $payload, \Ekiwok\QuickFixtures\GeneratorInterface $generator)
    {
        return new \DateTime($payload);
    }

    public function applies(\Ekiwok\QuickFixtures\ContextInterface $context, $payload)
    {
        $type = $context->getType();

        return $type->hasAnyClass()
            && $type->hasClass(\DateTime::class);
    }
});

$order = $generator->generate(Order::class, $data);

var_dump($order);