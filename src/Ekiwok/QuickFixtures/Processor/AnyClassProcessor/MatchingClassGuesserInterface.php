<?php

namespace Ekiwok\QuickFixtures\Processor\AnyClassProcessor;

use Ekiwok\QuickFixtures\Model\ClassDetails;

interface MatchingClassGuesserInterface
{
    /**
     * @param ClassDetails[] $classesDetails
     * @param array $properties
     *
     * @return ClassDetails
     */
    public function guessClass(array $classesDetails, array $properties);
}
