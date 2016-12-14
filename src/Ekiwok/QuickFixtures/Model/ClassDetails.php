<?php

namespace Ekiwok\QuickFixtures\Model;

class ClassDetails
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var PropertyDetails[]
     */
    private $properties;

    /**
     * @param string $name
     * @param PropertyDetails[] $properties
     */
    public function __construct($name, $properties)
    {
        $this->name = $name;
        $this->properties = $properties;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return PropertyDetails[]
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
