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

        list($classes, $scalars, $typedArrays) = $this->process($varString, $imports, $reflectionProperty);

        return new Type($classes, $scalars, $typedArrays);
    }

    /**
     * @param $varContent
     * @param array $imports
     * @param \ReflectionProperty $reflectionProperty
     *
     * @return array
     */
    private function process($varContent, array $imports, \ReflectionProperty $reflectionProperty)
    {
        $classes = [];
        $scalars = [];
        $typedArrays = [];

        if (empty($varContent)) {
            return [[], [], []];
        }

        $separated = explode('|', $varContent);

        foreach ($separated as $type) {

            if ($tmp = $this->maybeTypedArray($type, $imports, $reflectionProperty)) {
                $typedArrays[] = $tmp;
                continue;
            }

            if ($tmp = $this->maybeScalar($type)) {
                $scalars[] = $tmp;
                continue;
            }

            $classes[] = $this->generateFullClassifiedClassName($type, $imports, $reflectionProperty);
        }

        return [$classes, $scalars, $typedArrays];
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


    private function maybeTypedArray($type, array $imports, \ReflectionProperty $reflectionProperty)
    {
        if (substr($type, -2) !== '[]') {
            return;
        }

        $normalisedType = substr($type, 0, strlen($type) - 2);

        list($classes, $scalars, $typedArrays) = $this->process($normalisedType, $imports, $reflectionProperty);

        return new Type($classes, $scalars, $typedArrays);
    }

    private function generateFullClassifiedClassName($type, array $imports, \ReflectionProperty $reflectionProperty)
    {
        if ($type[0] === '\\') {
            return $type;
        }

        if (array_key_exists($type, $imports)) {
            return '\\' . $imports[$type];
        }

        $propertyDeclaringClassNamespace = $reflectionProperty->getDeclaringClass()
            ->getNamespaceName();

        return sprintf('\\%s\\%s', $propertyDeclaringClassNamespace, $type);
    }
}
