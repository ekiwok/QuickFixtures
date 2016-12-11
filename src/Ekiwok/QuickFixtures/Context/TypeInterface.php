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
     * @return string[]
     */
    public function getScalars();
}
