<?php

namespace Ekiwok\QuickFixtures\Model;

/*
 * In contrary to PropertyDetails instances of this class stores information about property that was overridden.
 *
 * Example of usage:
 *
 * new OverridenPropertyDetails($propertyBeingOverriden, $newProperty);
 */
class OverriddenPropertyDetails extends PropertyDetails
{
    /**
     * @var PropertyDetails[]
     */
    private $properties;

    /**
     * @param PropertyDetails|OverriddenPropertyDetails $baseProperty
     * @param PropertyDetails $overridingProperty
     */
    public function __construct(PropertyDetails $baseProperty, PropertyDetails $overridingProperty)
    {
        $this->properties = ($baseProperty instanceof static)
            ? $baseProperty->getProperties()
            : [$baseProperty];

        $this->properties[] = $overridingProperty;
    }

    /**
     * @return PropertyDetails[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return end($this->properties)->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return end($this->properties)->getType();
    }

    /**
     * {@inheritdoc}
     */
    public function getReflectionProperty()
    {
        return end($this->properties)->getReflectionProperty();
    }
}
