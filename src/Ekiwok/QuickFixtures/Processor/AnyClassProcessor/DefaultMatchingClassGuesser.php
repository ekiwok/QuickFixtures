<?php

namespace Ekiwok\QuickFixtures\Processor\AnyClassProcessor;

use Ekiwok\QuickFixtures\Model\ClassDetails;

class DefaultMatchingClassGuesser implements MatchingClassGuesserInterface
{
    /**
     * {@inheritdoc}
     */
    public function guessClass(array $classesDetails, array $properties)
    {
        if (empty($properties) || count($classesDetails) === 1) {
            return reset($classesDetails);
        }

        $score = -1;
        $bestMatchingClassDetails = null;

        /** @var ClassDetails $classDetails */
        foreach ($classesDetails as $classDetails) {
            $classProperties = array_keys($classDetails->getProperties());
            $classDetailsScore = count(array_intersect($classProperties, $properties));
            if ($classDetailsScore > $score) {
                $bestMatchingClassDetails = $classDetails;
            }
        }

        return $bestMatchingClassDetails;
    }
}
