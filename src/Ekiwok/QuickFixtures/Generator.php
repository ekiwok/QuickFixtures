<?php

namespace Ekiwok\QuickFixtures;

class Generator implements GeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate($class, $payload = null)
    {
        return new \stdClass();
    }
}
