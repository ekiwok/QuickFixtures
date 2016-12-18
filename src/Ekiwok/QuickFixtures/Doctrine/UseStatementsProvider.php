<?php

namespace Ekiwok\QuickFixtures\Doctrine;

use Doctrine\Common\Reflection\StaticReflectionParser;
use Ekiwok\QuickFixtures\Model\UseStatementsProviderInterface;

class UseStatementsProvider implements UseStatementsProviderInterface
{
    /**
     * @return array
     */
    public function getAllUseStatements($className)
    {
        $reader = new StaticReflectionParser($className);
    }
}
