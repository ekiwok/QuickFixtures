<?php

namespace Ekiwok\QuickFixtures\Processor;

use Ekiwok\QuickFixtures\ContextInterface;
use Ekiwok\QuickFixtures\GeneratorInterface;
use Ekiwok\QuickFixtures\Processor\Exception\UnsupportedPayloadException;

/**
 * This processor handles any class (this is why it's UndefinedClassProcessor in contrary to fe. DateTimeProcessor).
 */
class AnyClassProcessor implements PrioritisedProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContextInterface $context, $payload, GeneratorInterface $generator)
    {
        $classes = $context->getType()->getClasses();

        if (count($classes) > 1) {
            // do smth clever
        }
        $class = reset($classes);

        switch (gettype($payload))
        {
            case 'object':
                return $payload;

            case 'array':
            case 'NULL':
                $reflection = new \ReflectionClass($class);

                return $reflection->newInstanceWithoutConstructor();

            default:
                throw UnsupportedPayloadException::create(self::class, gettype($payload));
        }
    }

    /**
     * @param ContextInterface $context
     * @param mixed $payload
     *
     * @return mixed
     */
    public function applies(ContextInterface $context, $payload)
    {
        if (!$context->getType()->hasAnyClass()) {
            return false;
        }

        switch (gettype($payload))
        {
            case 'array':
            case 'NULL':
                return true;

            case 'object':
                return in_array(get_class($payload), $context->getType()->getClasses());

            default:
                return false;
        }
    }

    private function runRecursively(ContextInterface $context, array $payload, GeneratorInterface $generator)
    {
        
    }

}
