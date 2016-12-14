<?php

namespace Ekiwok\QuickFixtures\Factory;

use Doctrine\Common\Annotations\Reader;
use Ekiwok\QuickFixtures\Context\Type;
use Ekiwok\QuickFixtures\Model\Primitives;

class TypeFactory
{
    /**
     * @param \ReflectionProperty $reflectionProperty
     * @param string[] $imports
     *
     * @return Type
     */
    public function create(\ReflectionProperty $reflectionProperty, array $imports)
    {
        $matches = [];
        $comment = $reflectionProperty->getDocComment();

        preg_match('/(@var)\s+([^\s]+)/', $comment, $matches);
        $varString = end($matches);

        list($classes, $scalars, $arrayTypes) = $this->process($varString, $imports);

        return new Type($classes, $scalars);
    }

    private function process($varContent, array $imports)
    {
        $classes = [];
        $scalars = [];
        $arrayTypes = [];

        if (empty($varContent)) {
            return [[], [], []];
        }

        $separated = explode('|', $varContent);

        foreach ($separated as $type) {
            ($_ = $this->maybeScalar($type)) ? $scalars[] = $_ : null;
        }

        return [$classes, $scalars, $arrayTypes];
    }

    /**
     * @param $type
     *
     * @return string|null
     */
    private function maybeScalar($type)
    {
        $normalised = strtolower($type);

        if (!in_array($normalised, Primitives::DOCK_BLOCK_PRIMITIVES)) {
            return null;
        }

        return Primitives::NORMALIZATIONS[$normalised];
    }
}
