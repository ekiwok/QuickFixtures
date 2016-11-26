<?php

namespace Ekiwok\QuickFixtures\Context;

interface TypeInterface
{
    /**
     * @return bool
     */
    public function hasAnyClass();

    /**
     * @return array
     */
    public function getClasses();
}
