<?php

namespace Ekiwok\QuickFixtures\Context;

class Type implements TypeInterface
{
    /**
     * @var array
     */
    private $classes;

    /**
     * @param array $classes
     */
    public function __construct(array $classes = [])
    {
        $this->classes = $classes;
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
}
