<?php

namespace Ekiwok\QuickFixtures\Factory;

use Ekiwok\QuickFixtures\Model\ClassDetails;
use Ekiwok\QuickFixtures\Model\PropertyDetails;

class ClassDetailsFactory
{
    /**
     * @var TypeFactory
     */
    protected $typeFactory;

    /**
     * @param TypeFactory $typeFactory
     */
    public function __construct(TypeFactory $typeFactory)
    {
        $this->typeFactory = $typeFactory;
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

        $reflectionProperties = $reflection->getProperties();

        foreach ($reflectionProperties as $reflectionProperty) {
            $type = $this->typeFactory->create($reflectionProperty, []);
            $properties[] = new PropertyDetails($reflectionProperty->name, $type, $reflectionProperty);
        }

        return new ClassDetails($className, $properties);
    }

    private function getClassImports()
    {

    }
}
