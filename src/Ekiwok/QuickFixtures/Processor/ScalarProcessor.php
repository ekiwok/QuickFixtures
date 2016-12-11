<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

class ScalarProcessor implements ProcessorInterface
{
    const SUPPORTED_TYPES = ['integer', 'double', 'string', 'boolean'];

    /**
     * @param ContextInterface $context
     * @param mixed $payload
     * @param GeneratorInterface $generator
     *
     * @return mixed
     *
     * @throws UnsupportedPayloadException
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        $type = gettype($payload);
        $scalars = $context->getType()->getScalars();

        if (in_array($type, array_intersect($scalars, self::SUPPORTED_TYPES))) {
            return $payload;
        }

        if (!in_array($type, self::SUPPORTED_TYPES) || $type === 'boolean') {
            throw $this->createUnsupportedExpectedScalars($type, $scalars);
        }

        switch ($type)
        {
            case 'integer':
                return $this->castInteger($payload, $scalars);

            case 'string':
                return $this->castString($payload, $scalars);

            case 'double':
                return $this->castDouble($payload, $scalars);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function applies(ContextInterface $context, $payload)
    {
        $type = $context->getType();

        if (!is_scalar($payload) || !$type->hasAnyScalar()) {
            return false;
        }

        $scalars = $context->getType()->getScalars();

        switch(gettype($payload))
        {
            case 'boolean':
                return in_array('boolean', $scalars);

            case 'string':
                return in_array('string', $scalars)
                    || is_numeric($payload) && count(array_intersect(['integer', 'double'], $scalars));

            case 'double':
                return count(array_intersect(['string', 'double'], $scalars)) > 0;

            case 'integer':
                return count(array_intersect(['string', 'integer', 'double'], $scalars)) > 0;
        }

        return false;
    }

    /**
     * @param $integer
     * @param array $expectedScalars
     *
     * @return float|string
     *
     * @throws UnsupportedPayloadException
     */
    private function castInteger($integer, array $expectedScalars)
    {
        if (in_array('double', $expectedScalars)) {
            return (double) $integer;
        }
        if (in_array('string', $expectedScalars)) {
            return (string) $integer;
        }

        throw $this->createUnsupportedExpectedScalars('integer', $expectedScalars);
    }

    private function castString($string, array $expectedScalars)
    {
        $mayBeDoubleOrInteger = count(array_intersect(['integer', 'double'], $expectedScalars)) == 2;

        $double = doubleval($string);
        $integer = intval($string);

        if ($mayBeDoubleOrInteger) {
            return ((double) $integer === $double) ? $integer : $double;
        }

        if (in_array('integer', $expectedScalars)) {
            return $integer;
        }

        if (in_array('double', $expectedScalars)) {
            return $double;
        }

        throw $this->createUnsupportedExpectedScalars('string', $expectedScalars);
    }

    /**
     * @param $double
     * @param array $expectedScalars
     *
     * @return int|string
     *
     * @throws UnsupportedPayloadException
     */
    private function castDouble($double, array $expectedScalars)
    {
        if (in_array('string', $expectedScalars)) {
            return (string) $double;
        }

        throw $this->createUnsupportedExpectedScalars('double', $expectedScalars);
    }


    /**
     * @param $scalarType
     * @param $expectedScalars
     *
     * @return UnsupportedPayloadException
     */
    private function createUnsupportedExpectedScalars($scalarType, $expectedScalars)
    {
        return new UnsupportedPayloadException(sprintf(
            "Cannot cast type %s to any of expected types: %s",
            $scalarType,
            implode(', ', $expectedScalars)
        ));
    }
}
