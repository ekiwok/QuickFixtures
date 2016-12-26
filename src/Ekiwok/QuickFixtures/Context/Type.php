<?php

namespace Ekiwok\QuickFixtures\Context;

class Type implements TypeInterface
{
    /**
     * @var string[]
     */
    private $classes;

    /**
     * @var string[]
     */
    private $scalars;

    /**
     * @var Type[]
     */
    private $typedArrays;

    /**
     * @param string[] $classes
     * @param string[] $scalars
     * @param Type[] $typedArrays
     */
    public function __construct(array $classes = [], array $scalars = [], array $typedArrays = [])
    {
        $this->classes = $classes;
        $this->scalars = $scalars;
        $this->typedArrays = $typedArrays;
    }

    /**
     * @return bool
     */
    public function hasAnyClass()
    {
        return !empty($this->classes);
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @return Type[]
     */
    public function getTypedArrays()
    {
        return $this->typedArrays;
    }

    /**
     * @return bool
     */
    public function hasAnyScalar()
    {
        return !empty($this->scalars);
    }

    /**
     * @return string[]
     */
    public function getScalars()
    {
        return $this->scalars;
    }

    /**
     * @return bool
     */
    public function hasAnyTypedArray()
    {
        return !empty($this->typedArrays);
    }

    /**
     * @return boolean
     */
    public function hasClass($className)
    {
        if ($className[0] !== '\\') {
            $className = '\\'.$className;
        }

        return in_array($className, $this->classes);
    }
}
