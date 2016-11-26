<?php

namespace Ekiwok\QuickFixtures\Context;

use Ekiwok\QuickFixtures\Context\Exception\EmptyPathException;

interface PathInterface
{
    /**
     * @return array
     */
    public function getPath();

    /**
     * @param string $path
     *
     * @return PathInterface
     */
    public function push($path);

    /**
     * @throws EmptyPathException
     *
     * @return PathInterface
     */
    public function pop();

    /**
     * @return string
     */
    public function __toString();
}
