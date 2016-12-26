<?php

namespace spec\Ekiwok\QuickFixtures\fixtures\classes;

use spec\Ekiwok\QuickFixtures\fixtures\classes\Baz\Nested;

class Bizz extends Bar
{
    use CreatedAtUpdatedAtTrait;

    /**
     * @var Nested
     */
    private $nested;

    /**
     * @return Nested
     */
    public function getNested()
    {
        return $this->nested;
    }
}
