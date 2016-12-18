<?php

namespace Ekiwok\QuickFixtures\Model;

interface UseStatementsProviderInterface
{
    /**
     * @return array
     */
    public function getAllUseStatements($className);
}
