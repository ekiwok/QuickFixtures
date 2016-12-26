<?php

namespace Ekiwok\QuickFixtures\Provider;

use Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;
use Ekiwok\QuickFixtures\Model\ClassDetailsRegistry;

class ClassDetailsProvider
{
    /**
     * @var ClassDetailsFactory
     */
    private $factory;

    /**
     * @var ClassDetailsRegistry
     */
    private $classDetailsRegistry;

    /**
     * @param ClassDetailsFactory $factory
     */
    public function __construct(ClassDetailsFactory $factory, ClassDetailsRegistry $classDetailsRegistry)
    {
        $this->factory = $factory;
        $this->classDetailsRegistry = $classDetailsRegistry;
    }

    /**
     * @param string $className
     *
     * @return \Ekiwok\QuickFixtures\Model\ClassDetails
     */
    public function getDetailsFor($className)
    {
        if ($this->classDetailsRegistry->has($className)) {
            return $this->classDetailsRegistry->get($className);
        }

        $classDetails = $this->factory->create($className);
        $this->classDetailsRegistry->register($classDetails);

        return $classDetails;
    }
}
