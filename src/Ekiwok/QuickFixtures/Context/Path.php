<?php

namespace Ekiwok\QuickFixtures\Context;

use Ekiwok\QuickFixtures\Context\Exception\EmptyPathException;

class Path implements PathInterface
{
    const PATH_SEPARATOR = '.';

    /**
     * @var array
     */
    private $path = [];

    /**
     * {@inheritdoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function push($path)
    {
        $this->path[] = $path;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function pop()
    {
        if (empty($this->path)) {
            throw new EmptyPathException();
        }

        array_pop($this->path);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode('.', $this->path);
    }
}
