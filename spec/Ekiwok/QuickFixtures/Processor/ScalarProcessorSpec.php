<?php

namespace spec\Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Context\TypeInterface;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;
use Ekiwok\QuickFixtures\Processor\ScalarProcessor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ScalarProcessorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ScalarProcessor::class);
    }

    function it_should_not_apply_when_type_has_no_scalars(ContextInterface $context)
    {
        $type = new Type([], []);
        $context->getType()->willReturn($type);

        $this->applies($context, 3)->shouldBe(false);
    }

    function it_should_apply_to_integer(ContextInterface $context)
    {
        $type = new Type([], ['integer']);
        $context->getType()->willReturn($type);

        $this->applies($context, 3)->shouldBe(true);
    }

    function it_should_apply_to_integer_when_payload_is_string(ContextInterface $context)
    {
        $type = new Type([], ['integer']);
        $context->getType()->willReturn($type);

        $this->applies($context, '3')->shouldBe(true);
    }

    function it_should_not_apply_to_integer_when_payload_is_double(ContextInterface $context)
    {
        $type = new Type([], ['integer']);
        $context->getType()->willReturn($type);

        $this->applies($context, 3.14)->shouldBe(false);
    }

    function it_should_apply_to_double(ContextInterface $context)
    {
        $type = new Type([], ['double']);
        $context->getType()->willReturn($type);

        $this->applies($context, 3.14)->shouldBe(true);
    }

    function it_should_apply_to_double_when_payload_is_string(ContextInterface $context)
    {
        $type = new Type([], ['double']);
        $context->getType()->willReturn($type);

        $this->applies($context, '3.14')->shouldBe(true);
    }

    function it_should_apply_to_boolean(ContextInterface $context)
    {
        $type = new Type([], ['boolean']);
        $context->getType()->willReturn($type);

        $this->applies($context, true)->shouldBe(true);
        $this->applies($context, false)->shouldBe(true);
    }

    function it_should_not_apply_to_boolean_when_payload_is_string(ContextInterface $context)
    {
        $type = new Type([], ['boolean']);
        $context->getType()->willReturn($type);

        $this->applies($context, 'true')->shouldBe(false);
    }

    function it_should_apply_to_string(ContextInterface $context)
    {
        $type = new Type([], ['string']);
        $context->getType()->willReturn($type);

        $this->applies($context, '3 fiddy')->shouldBe(true);
    }

    function it_should_apply_to_string_when_payload_is_integer(ContextInterface $context)
    {
        $type = new Type([], ['string']);
        $context->getType()->willReturn($type);

        $this->applies($context, 3)->shouldBe(true);
    }

    function it_should_apply_to_string_when_payload_is_double(ContextInterface $context)
    {
        $type = new Type([], ['string']);
        $context->getType()->willReturn($type);

        $this->applies($context, 3.14)->shouldBe(true);
    }

    function it_should_not_apply_to_string_when_payload_is_boolean(ContextInterface $context)
    {
        $type = new Type([], ['string']);
        $context->getType()->willReturn($type);

        $this->applies($context, true)->shouldBe(false);
        $this->applies($context, false)->shouldBe(false);
    }

    function it_should_not_apply_to_array(ContextInterface $context)
    {
        $type = new Type([], ['string', 'boolean']);
        $context->getType()->willReturn($type);

        $this->applies($context, ['3 fiddy'])->shouldBe(false);
        $this->applies($context, [3])->shouldBe(false);
        $this->applies($context, [3.14])->shouldBe(false);
        $this->applies($context, [true])->shouldBe(false);
    }

    function it_should_not_apply_to_resource(ContextInterface $context)
    {
        $type = new Type([], ['string', 'boolean', 'resource']);
        $context->getType()->willReturn($type);

        $resource = fopen(__FILE__, 'r');

        $this->applies($context, $resource)->shouldBe(false);

        fclose($resource);
    }

    function it_should_not_apply_to_object(ContextInterface $context)
    {
        $type = new Type([], ['string', 'boolean']);
        $context->getType()->willReturn($type);

        $this->applies($context, new \stdClass())->shouldBe(false);
    }

    function it_should_process_integer(ContextInterface $context, GeneratorInterface $generator)
    {
        $type = new Type([], ['integer', 'string']);
        $context->getType()->willReturn($type);

        $this->process($context, 3, $generator)->shouldBe(3);
    }

    function it_should_process_integer_as_string_when_string_is_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['string', 'boolean']);
        $context->getType()->willReturn($type);

        $this->process($context, 3, $generator)->shouldBe('3');
    }

    function it_should_process_integer_as_double_when_string_and_double_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['string', 'boolean', 'double']);
        $context->getType()->willReturn($type);

        $this->process($context, 3, $generator)->shouldBe(3.0);
    }

    function it_should_throw_an_expection_processing_integer_when_boolean_or_weird_things_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['boolean', 'elephpant']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, 3, $generator);
    }

    function it_should_process_string(ContextInterface $context, GeneratorInterface $generator)
    {
        $type = new Type([], ['integer', 'string']);
        $context->getType()->willReturn($type);

        $this->process($context, '3 fiddy', $generator)->shouldBe('3 fiddy');
    }

    function it_should_process_string_as_double_when_double_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['double', 'boolean']);
        $context->getType()->willReturn($type);

        $this->process($context, '3 fiddy', $generator)->shouldBe(3.0);
    }

    function it_should_process_string_as_integer_when_integer_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['boolean', 'integer']);
        $context->getType()->willReturn($type);

        $this->process($context, '3.14', $generator)->shouldBe(3);
    }

    function it_should_process_string_as_double_when_its_more_double_than_integer_and_any_numeric_type_goes(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['double', 'integer']);
        $context->getType()->willReturn($type);

        $this->process($context, '3.14', $generator)->shouldBe(3.14);
    }

    function it_should_process_string_as_integer_when_its_more_integer_than_double_and_any_numeric_type_goes(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['double', 'integer']);
        $context->getType()->willReturn($type);

        $this->process($context, '3', $generator)->shouldBe(3);
    }

    function it_should_throw_an_expection_processing_string_when_boolean_or_weird_things_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['boolean', 'elephpant']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, '3 fiddy', $generator);
    }

    function it_should_process_double(ContextInterface $context, GeneratorInterface $generator)
    {
        $type = new Type([], ['string', 'double']);
        $context->getType()->willReturn($type);

        $this->process($context, 3.14, $generator)->shouldBe(3.14);
    }

    function it_should_process_double_as_string_when_string_is_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['string', 'boolean']);
        $context->getType()->willReturn($type);

        $this->process($context, 3.14, $generator)->shouldBe('3.14');
    }

    function it_should_throw_an_expection_when_processing_double_and_integer_is_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['boolean', 'integer']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, 3.14, $generator);
    }

    function it_should_throw_an_expection_processing_double_when_boolean_or_weird_things_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['boolean', 'elephpant']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, 3.14, $generator);
    }

    function it_should_process_boolean(ContextInterface $context, GeneratorInterface $generator)
    {
        $type = new Type([], ['boolean', 'string']);
        $context->getType()->willReturn($type);

        $this->process($context, true, $generator)->shouldBe(true);
        $this->process($context, false, $generator)->shouldBe(false);
    }

    function it_should_throw_an_expection_processing_boolean_when_boolean_is_not_expected(
        ContextInterface $context,
        GeneratorInterface $generator
    ) {
        $type = new Type([], ['integer', 'double', 'string', 'elephpant']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, true, $generator);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, false, $generator);
    }

    function it_should_throw_an_expection_when_processing_null(
        ContextInterface $context,
        GeneratorInterface $generator,
        TypeInterface $type
    ) {
        $type->getScalars()->willReturn([]);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, null, $generator);
    }

    function it_should_throw_an_expection_when_processing_array(
        ContextInterface $context,
        GeneratorInterface $generator,
        TypeInterface $type
    ) {
        $type->getScalars()->willReturn(['array']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, [], $generator);
    }

    function it_should_throw_an_expection_when_processing_resource(
        ContextInterface $context,
        GeneratorInterface $generator,
        TypeInterface $type
    ) {
        $type->getScalars()->willReturn(['array']);
        $context->getType()->willReturn($type);

        $resource = fopen(__FILE__, 'r');

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, $resource, $generator);

        fclose($resource);
    }

    function it_should_throw_an_expection_when_processing_object(
        ContextInterface $context,
        GeneratorInterface $generator,
        TypeInterface $type
    ) {
        $type->getScalars()->willReturn(['array']);
        $context->getType()->willReturn($type);

        $this->shouldThrow(UnsupportedPayloadException::class)
            ->duringProcess($context, new \stdClass(), $generator);
    }
}
