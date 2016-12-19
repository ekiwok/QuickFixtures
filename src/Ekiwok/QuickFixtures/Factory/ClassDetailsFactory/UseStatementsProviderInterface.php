<?php

namespace Ekiwok\QuickFixtures\Factory\ClassDetailsFactory;

interface UseStatementsProviderInterface
{
    /**
     * @return array
     */
    public function getUseStatements(\ReflectionClass $class);
}
