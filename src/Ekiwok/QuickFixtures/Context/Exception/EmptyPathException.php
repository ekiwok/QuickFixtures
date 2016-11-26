<?php

namespace Ekiwok\QuickFixtures\Context\Exception;

final class EmptyPathException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Path is empty.");
    }
}
