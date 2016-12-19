<?php

namespace Ekiwok\QuickFixtures\Factory;

use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory\UseStatementsProviderInterface;
use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\OverriddenPropertyDetails;
use Ekiwok\QuickFixtures\Model\PropertyDetails;

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
            $useStatements = $this->useStatementsProvider
                ->getUseStatements($reflectionProperty->getDeclaringClass());

            $type = $this->typeFactory->create($reflectionProperty, $useStatements);
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
