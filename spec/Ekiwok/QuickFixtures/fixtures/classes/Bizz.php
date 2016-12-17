<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;

class Bizz extends Bar
{
    use CreatedUpdatedAtTrait;

    /**
     * @var Nested
     */
    private $nested;
}
