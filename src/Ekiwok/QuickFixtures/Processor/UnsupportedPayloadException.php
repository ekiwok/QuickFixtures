<?php

namespace Ekiwok\QuickFixtures\Processor;

class UnsupportedPayloadException extends \Exception
{
    public static function create($processor, $payloadType)
    {
        return new self(
            sprintf('Processor %s cannot process payload of type %s', $processor, $payloadType)
        );
    }
}