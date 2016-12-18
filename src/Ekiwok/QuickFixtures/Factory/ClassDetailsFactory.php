<?php

namespace Ekiwok\QuickFixtures\Factory;

use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\OverriddenPropertyDetails;
use Ekiwok\QuickFixtures\Model\PropertyDetails;
use Ekiwok\QuickFixtures\Model\UseStatementsProviderInterface;

class ClassDetailsFactory
{
    /**
     * @var TypeFactory
     */
    protected $typeFactory;

    /**
     * @var UseStatementsProviderInterface
     */
    protected $useStatementsProvider;

    /**
     * @param TypeFactory $typeFactory
     * @param UseStatementsProviderInterface $useStatementsProvider
     */
    public function __construct(TypeFactory $typeFactory, UseStatementsProviderInterface $useStatementsProvider)
    {
        $this->typeFactory = $typeFactory;
        $this->useStatementsProvider = $useStatementsProvider;
    }

    /**
     * @param string $className
     *
     * @return ClassDetails
     */
    public function create($className)
    {
        $properties = [];
        $reflection = new \ReflectionClass($className);

        $reflectionProperties = $this->getProperties($reflection);

        foreach ($reflectionProperties as $reflectionProperty) {
            $type = $this->typeFactory->create($reflectionProperty, []);
            $propertyDetails = new PropertyDetails($reflectionProperty->name, $type, $reflectionProperty);

            if (array_key_exists($reflectionProperty->name, $properties)) {
                $propertyDetails = new OverriddenPropertyDetails(
                    $properties[$reflectionProperty->name],
                    $propertyDetails
                );
            }

            $properties[$reflectionProperty->name] = $propertyDetails;
        }

        return new ClassDetails($className, $properties);
    }

    private function getProperties(\ReflectionClass $reflectionClass)
    {
        $properties = $reflectionClass->getProperties();

        $parentClass = $reflectionClass->getParentClass();
        $parentProperties = (!$parentClass)
            ? []
            : $this->getProperties($parentClass);

        return array_merge($properties, $parentProperties);
    }
}
