<?php

namespace Ekiwok\QuickFixtures;

interface GeneratorInterface
{
    /**
     * @param string $class
     * @param array|\Traversable $payload
     *
     * @return mixed
     */
    public function generate($class, $payload = null);
}
