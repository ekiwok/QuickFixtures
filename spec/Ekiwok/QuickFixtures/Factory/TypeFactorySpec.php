<?php

namespace spec\Ekiwok\QuickFixtures\Factory;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\SimpleAnnotationReader;
use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Factory\TypeFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Bar;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz;
use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;

class TypeFactorySpec extends ObjectBehavior
{
    const BACKSLASH_PREFIXED = '\\';

    function it_is_initializable()
    {
        $this->shouldHaveType(TypeFactory::class);
    }

    function it_creates_type_of_primitive_property()
    {
        $property = new \ReflectionProperty(Bar::class, 'bar');

        /** @var Type $type */
        $type = $this->create($property, []);

        $type->getClasses()->shouldBeLike([]);
        $type->getScalars()->shouldBeLike(['string']);
    }

    function it_creates_type_of_property_in_the_owning_class_namespace()
    {
        $property = new \ReflectionProperty(Baz::class, 'bar');
        $imports = ['Nested' => Nested::class];

        /** @var Type $type */
        $type = $this->create($property, $imports);

        $type->getClasses()->shouldBeLike([self::BACKSLASH_PREFIXED . Bar::class]);
    }

    function it_creates_type_of_property_in_imported_namespace()
    {
        $property = new \ReflectionProperty(Baz::class, 'nested');
        $imports = ['Nested' => Nested::class];

        /** @var Type $type */
        $type = $this->create($property, $imports);

        $type->getClasses()->shouldBe([self::BACKSLASH_PREFIXED . Nested::class]);
    }

    function it_creates_type_of_property_in_global_namespace()
    {
        $property = new \ReflectionProperty(Baz::class, 'dueAt');
        $imports = ['Nested' => Nested::class];

        /** @var Type $type */
        $type = $this->create($property, $imports);

        $type->getClasses()->shouldBe([self::BACKSLASH_PREFIXED . \DateTime::class]);
    }

    function it_creates_type_of_property_of_array_of_datetimes()
    {
        $property = new \ReflectionProperty(Baz::class, 'occurrences');
        $imports = ['Nested' => Nested::class];

        /** @var Type $type */
        $type = $this->create($property, $imports);

        $type->getTypedArrays()->shouldBeArray();

        $typedArrays = $type->getTypedArrays();
        $typedArrays->shouldHaveCount(1);

        $dateTimeType = $typedArrays[0];
        $dateTimeType->shouldBeAnInstanceOf(Type::class);

        $classes = $dateTimeType->getClasses();
        $classes->shouldHaveCount(1);

        $dateTimeClass = $classes[0];
        $dateTimeClass->shouldBe(self::BACKSLASH_PREFIXED . \DateTime::class);
    }

    function it_creates_type_of_property_accepting_very_different_types()
    {
        $property = new \ReflectionProperty(Baz::class, 'phantasmagoria');
        $imports = ['Nested' => Nested::class];

        /** @var Type $type */
        $type = $this->create($property, $imports);

        $type->getTypedArrays()->shouldBeArray();

        $classes = $type->getClasses();
        $classes->shouldHaveCount(1);

        $scalars = $type->getScalars();
        $scalars->shouldHaveCount(3);

        $typedArrays = $type->getTypedArrays();
        $typedArrays->shouldHaveCount(3);
    }
}
