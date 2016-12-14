<?php

namespace Ekiwok\QuickFixtures\Model;

use Ekiwok\QuickFixtures\Context\TypeInterface;

class PropertyDetails
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var TypeInterface
     */
    private $type;

    /**
     * @var \ReflectionProperty
     */
    private $reflectionProperty;

    /**
     * @param string $name
     * @param TypeInterface $type
     */
    public function __construct($name, TypeInterface $type, \ReflectionProperty $reflectionProperty)
    {
        $this->name = $name;
        $this->type = $type;
        $this->reflectionProperty = $reflectionProperty;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \ReflectionProperty
     */
    public function getReflectionProperty()
    {
        return $this->reflectionProperty;
    }
}
