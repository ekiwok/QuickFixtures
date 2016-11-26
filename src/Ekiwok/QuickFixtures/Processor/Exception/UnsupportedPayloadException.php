<?php

namespace Ekiwok\QuickFixtures\Processor\Exception;

class UnsupportedPayloadException extends \Exception
{
    public static function create($processor, $payloadType)
    {
        return new self(
            sprintf('Processor %s cannot process payload of type %s', $processor, $payloadType)
        );
    }
}