<?php

namespace Ekiwok\QuickFixtures;

interface GeneratorInterface
{
    /**
     * $context might be any string that TypeFactory is able to process
     * or any instance implementing ContextInterface.
     *
     * This method might be also called recursively by processor when it'll need
     * some property to be generated. This is the most common scenario when this
     * method will be called with ContextInterface as parameter.
     *
     * In userspace the most common scenario probably will be
     *
     * @param string|ContextInterface $context
     * @param null|array|\Traversable $payload
     *
     * @return mixed
     */
    public function generate($context, $payload = null);
}
