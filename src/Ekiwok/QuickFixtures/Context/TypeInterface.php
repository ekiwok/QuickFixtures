<?php

namespace Ekiwok\QuickFixtures\Context;

interface TypeInterface
{
    /**
     * @return bool
     */
    public function hasAnyClass();

    /**
     * @return bool
     */
    public function hasAnyScalar();

    /**
     * @return string[]
     */
    public function getClasses();

    /**
     * @param string $className
     *
     * @return boolean
     */
    public function hasClass($className);

    /**
     * @return string[]
     */
    public function getScalars();

    /**
     * @return Type[]
     */
    public function getTypedArrays();
}
