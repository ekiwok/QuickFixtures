<?php

namespace Ekiwok\QuickFixtures\Generator;

class UnsupportedContextException extends \Exception
{
    /**
     * @param string $generator
     *
     * @param string $context
     */
    public function __construct($generator, $context)
    {
        $message = sprintf("%s cannot process given context: %s", $generator, $context);

        parent::__construct($message);
    }
}
