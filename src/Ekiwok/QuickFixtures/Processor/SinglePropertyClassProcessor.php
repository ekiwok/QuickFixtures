<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context\TypeInterface;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;

class SinglePropertyClassProcessor implements PrioritisedProcessorInterface
{
    /**
     * @var ClassDetailsProvider
     */
    private $classDetailsProvider;

    /**
     * @param ClassDetailsProvider $classDetailsProvider
     */
    public function __construct(ClassDetailsProvider $classDetailsProvider)
    {
        $this->classDetailsProvider = $classDetailsProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return static::BUILT_IN_PROCESSORS_PRIORITIES[static::class];
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        $type = $context->getType();
        $classDetails = $this->findMatchingClass($type, $payload);

        if (is_null($classDetails)) {
            throw UnsupportedPayloadException::create(self::class, gettype($payload));
        }

        $properties = $classDetails->getProperties();
        $property = reset($properties)->getReflectionProperty();
        if ($property->isPrivate() || $property->isProtected()) {
            $property->setAccessible(true);
        }
        $class = $property->getDeclaringClass();

        $object = $class->newInstanceWithoutConstructor();
        $property->setValue($object, $payload);

        return $object;
    }

    /**
     * {@inheritdoc}
     */
    public function applies(ContextInterface $context, $payload)
    {
        $type = $context->getType();

        return !is_null($this->findMatchingClass($type, $payload));
    }

    /**
     * It ensures that, if returned, ClassDetails have only one property.
     *
     * @param TypeInterface $type
     * @param mixed $payload
     *
     * @return \Ekiwok\QuickFixtures\Model\ClassDetails|null
     */
    private function findMatchingClass(TypeInterface $type, $payload)
    {
        $payloadType = gettype($payload);

        foreach ($type->getClasses() as $className) {
            $classDetails = $this->classDetailsProvider->getDetailsFor($className);

            if (count($classDetails->getProperties()) != 1) {
                continue;
            }

            $properties = $classDetails->getProperties();
            $propertyType = reset($properties)->getType();

            $propertyTypeHasTheSameTypeAsPayload = $propertyType->hasAnyScalar()
                && in_array($payloadType, $propertyType->getScalars());

            if ($propertyTypeHasTheSameTypeAsPayload) {
                return $classDetails;
            }
        }
    }
}
