<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;

/**
 * Used for TypeFactorySpec
 */
class Baz
{
    /**
     * @var Bar
     */
    private $bar;

    /**
     * @var Nested
     */
    private $nested;

    /**
     * @var \DateTime
     */
    private $dueAt;

    /**
     * @var \DateTime[]
     */
    private $occurrences;

    /**
     * @var null|\DateTime[]|Nested[]|array|int[]|string|Bar
     */
    private $phantasmagoria;
}
