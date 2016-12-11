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
     * @param string[] $classes
     * @param string[] $scalars
     */
    public function __construct(array $classes = [], array $scalars = [])
    {
        $this->classes = $classes;
        $this->scalars = $scalars;
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
}
