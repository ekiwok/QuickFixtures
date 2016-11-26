<?php

namespace Ekiwok\QuickFixtures;

use Ekiwok\QuickFixtures\Context\PathInterface;
use Ekiwok\QuickFixtures\Context\TypeInterface;

interface ContextInterface
{
    /**
     * @return PathInterface
     */
    public function getPath();

    /**
     * @return TypeInterface
     */
    public function getType();
}
