<?php

namespace Ekiwok\QuickFixtures\Factory;

use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory\UseStatementsProvider;
use Ekiwok\QuickFixtures\Generator;
use Ekiwok\QuickFixtures\Model\ClassDetailsRegistry;
use Ekiwok\QuickFixtures\Processor\AnyClassProcessor;
use Ekiwok\QuickFixtures\Processor\ScalarProcessor;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;

class GeneratorFactory
{
    public function create()
    {
        $generator = new Generator();

        $classDetailsProvider = new ClassDetailsProvider(
            new ClassDetailsFactory(
                new TypeFactory(),
                new UseStatementsProvider()
            ),
            new ClassDetailsRegistry()
        );

        $generator->addProcessor(new ScalarProcessor());
        $generator->addProcessor(new AnyClassProcessor($classDetailsProvider));

        return $generator;
    }
}
