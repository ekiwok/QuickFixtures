<?php

namespace spec\Ekiwok\QuickFixtures;

use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;
use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory\UseStatementsProvider;
use Ekiwok\QuickFixtures\Factory\TypeFactory;
use Ekiwok\QuickFixtures\Generator;
use Ekiwok\QuickFixtures\Model\ClassDetailsRegistry;
use Ekiwok\QuickFixtures\Processor\AnyClassProcessor;
use Ekiwok\QuickFixtures\Processor\ScalarProcessor;
use Ekiwok\QuickFixtures\Processor\TypedArraysProcessor;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bizz;
use spec\Ekiwok\QuickFixtures\fixtures\classes\ExampleWithCollections;
use spec\Ekiwok\QuickFixtures\GeneratorSpec\AtCreatedAtPathProcessor;
use spec\Ekiwok\QuickFixtures\GeneratorSpec\DateTimeProcessor;

class GeneratorSpec extends ObjectBehavior
{
    function let()
    {
        $classDetailsProvider = new ClassDetailsProvider(
            new ClassDetailsFactory(
                new TypeFactory(),
                new UseStatementsProvider()
            ),
            new ClassDetailsRegistry()
        );

        $this->addProcessor(new ScalarProcessor());
        $this->addProcessor(new AnyClassProcessor($classDetailsProvider));
        $this->addProcessor(new TypedArraysProcessor());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Generator::class);
    }

    function it_generates_complex_class_with_traits_correctly()
    {
        $this->addProcessor(new DateTimeProcessor());

        $bizz = $this->generate(Bizz::class, [
            'bar' => 'test',
            'createdAt' => '2004-02-12T15:19:21+00:00',
            'updatedAt' => '2014-10-01T15:19:21+01:00',
            'nested' => "",
        ]);

        $bizz->getBar()->shouldBe('test');
        $bizz->getCreatedAt()->shouldHaveType(\DateTime::class);
        $bizz->getUpdatedAt()->shouldHaveType(\DateTime::class);
        $bizz->getNested()->shouldHaveType(Nested::class);
    }

    function it_generates_uses_class_extending_abstract_path_processor_correctly()
    {
        $this->addProcessor(new DateTimeProcessor());
        $this->addProcessor(new AtCreatedAtPathProcessor());

        $bizz = $this->generate(Bizz::class, [
            'bar' => 'test',
            'createdAt' => '2004-02-12T15:19:21+00:00',
            'updatedAt' => '2014-10-01T15:19:21+01:00',
            'nested' => "",
        ]);

        $bizz->getBar()->shouldBe('test');
        $bizz->getCreatedAt()->shouldHaveType(\stdClass::class);
        $bizz->getUpdatedAt()->shouldHaveType(\DateTime::class);
        $bizz->getNested()->shouldHaveType(Nested::class);
    }

    function it_generates_class_with_property_being_collection_of_properties()
    {
        $this->addProcessor(new DateTimeProcessor());

        /** @var ExampleWithCollections $result */
        $result = $this->generate(ExampleWithCollections::class, [
            'bizzes' => [
                [
                    'bar' => 'test',
                    'createdAt' => '2004-02-12T15:19:21+00:00',
                    'updatedAt' => '2014-10-01T15:19:21+01:00',
                    'nested' => "",
                ],
                [
                    'bar' => 'another test',
                    'createdAt' => '2004-02-12T15:19:21+00:00',
                    'updatedAt' => '2014-10-01T15:19:21+01:00',
                    'nested' => "",
                ]
            ],
            'numbers' => [1,3,5.5,8,13.5],
        ]);

        $bizzes = $result->getBizzes();
        foreach ($bizzes as $bizz) {
            $bizz->shouldHaveType(Bizz::class);
        }

        $result->getNumbers()->shouldHaveCount(5);
    }
}
