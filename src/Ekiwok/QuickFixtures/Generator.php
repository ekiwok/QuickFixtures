<?php

namespace Ekiwok\QuickFixtures;

class Generator implements GeneratorInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate($context, $payload = null)
    {
        return new \stdClass();
    }
}
