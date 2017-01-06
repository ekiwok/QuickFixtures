<?php

namespace Ekiwok\QuickFixtures\Generator;

class UnsupportedContextException extends \Exception
{
    /**
     * @var UnsupportedContextException[]
     */
    private $previous = [];

    /**
     * @param string $generator
     * @param UnsupportedContextException[] $previous
     *
     * @param string $context
     */
    public function __construct($generator, $context, UnsupportedContextException ...$previous)
    {
        $this->previous = $previous;
        $message = sprintf("%s cannot process given context: %s", $generator, $context);

        parent::__construct($message);
    }

    /**
     * @return UnsupportedContextException[]
     */
    public function getPreviousUnsupportedContextExceptions()
    {
        return $this->previous;
    }
}
