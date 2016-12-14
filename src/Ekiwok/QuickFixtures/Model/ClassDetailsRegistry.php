<?php

namespace Ekiwok\QuickFixtures\Model;

class ClassDetailsRegistry
{
    /**
     * @var ClassDetails[]
     */
    private $classDetails = [];

    /**
     * @param ClassDetails $classDetails
     */
    public function register(ClassDetails $classDetails)
    {
        $this->classDetails[$classDetails->getName()] = $classDetails;
    }

    /**
     * @param string $className
     *
     * @return ClassDetails
     */
    public function get($className)
    {
        if (!array_key_exists($className, $this->classDetails)) {
            throw new \RuntimeException(sprintf("Class %s is not registered.", $className));
        }

        return $this->classDetails[$className];
    }
}
