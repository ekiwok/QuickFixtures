<?php

namespace Ekiwok\QuickFixtures;

use Ekiwok\QuickFixtures\Context\Path;
use Ekiwok\QuickFixtures\Context\PathInterface;
use Ekiwok\QuickFixtures\Context\TypeInterface;

class Context implements ContextInterface
{
    /**
     * @var PathInterface
     */
    private $path;

    /**
     * @var TypeInterface
     */
    private $type;

    /**
     * @param TypeInterface $type
     * @param null|PathInterface $path
     */
    public function __construct(TypeInterface $type, PathInterface $path = null)
    {
        $this->path = $path ?: new Path();
        $this->type = $type;
    }

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
    public function getType()
    {
        return $this->type;
    }
}
