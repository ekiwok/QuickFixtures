<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\Context;
use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Processor\AnyClassProcessor\DefaultMatchingClassGuesser;
use Ekiwok\QuickFixtures\Processor\AnyClassProcessor\MatchingClassGuesserInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;
use Ekiwok\QuickFixtures\Provider\ClassDetailsProvider;

class AnyClassProcessor implements PrioritisedProcessorInterface
{
    /**
     * @var ClassDetailsProvider
     */
    private $classDetailsProvider;

    /**
     * @var MatchingClassGuesserInterface
     */
    private $matchingClassGuesser;

    /**
     * @param ClassDetailsProvider $classDetailsProvider
     * @param MatchingClassGuesserInterface $matchingClassGuesser
     */
    public function __construct(
        ClassDetailsProvider $classDetailsProvider,
        MatchingClassGuesserInterface $matchingClassGuesser = null
    ) {
        $this->classDetailsProvider = $classDetailsProvider;
        $this->matchingClassGuesser = $matchingClassGuesser ?: new DefaultMatchingClassGuesser();
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        $classes = $context->getType()->getClasses();
        $classesDetails = [];
        foreach ($classes as $class) {
            $classesDetails[] = $this->classDetailsProvider
                ->getDetailsFor($class);
        }
        $properties = is_array($payload) ? array_keys($payload) : [];

        $classDetails = $this->matchingClassGuesser->guessClass($classesDetails, $properties);

        switch (gettype($payload))
        {
            case 'object':
                return $payload;

            case 'array':
                return $this->concreteProcessFromArray($classDetails, $context, $payload, $generator);

            case 'NULL':
                return (new \ReflectionClass($classDetails->getName()))->newInstanceWithoutConstructor();

            case 'string':
                if (empty($payload)) {
                    return (new \ReflectionClass($classDetails->getName()))->newInstanceWithoutConstructor();
                }
                // no break

            default:
                throw UnsupportedPayloadException::create(self::class, gettype($payload));
        }
    }

    /**
     * @param ContextInterface $context
     * @param mixed $payload
     *
     * @return mixed
     */
    public function applies(ContextInterface $context, $payload)
    {
        if (!$context->getType()->hasAnyClass()) {
            return false;
        }

        switch (gettype($payload))
        {
            case 'array':
            case 'NULL':
                return true;

            case 'string':
                return empty($payload);

            case 'object':
                return in_array(get_class($payload), $context->getType()->getClasses());

            default:
                return false;
        }
    }

    private function concreteProcessFromArray(
        ClassDetails $classDetails,
        ContextInterface $context,
        array $payload,
        GeneratorInterface $generator
    ) {
        $object = (new \ReflectionClass($classDetails->getName()))->newInstanceWithoutConstructor();

        foreach ($classDetails->getProperties() as $property) {
            $propertyName = $property->getName();
            if (!array_key_exists($propertyName, $payload)) {
                continue;
            }

            $path = clone $context->getPath();
            $path->push($propertyName);

            $value = $generator->generate(
                new Context($property->getType(), $path),
                $payload[$propertyName]
            );

            $this->setPropertyValue($object, $value, $property->getReflectionProperty());
        }

        return $object;
    }

    /**
     * @param mixed $object
     * @param mixed $value
     * @param \ReflectionProperty $reflectionProperty
     */
    private function setPropertyValue($object, $value, \ReflectionProperty $reflectionProperty)
    {
        if ($reflectionProperty->isPrivate() || $reflectionProperty->isProtected()) {
            $reflectionProperty->setAccessible(true);
        }

        $reflectionProperty->setValue($object, $value);
    }

}
