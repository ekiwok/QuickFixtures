<?php

declare(strict_types=1);

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Address
{
    /**
     * @var string
     */
    private $line1;

    /**
     * @var string
     */
    private $line2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postCode;

    public function __construct(string $line1, string $line2, string $city, string $postCode)
    {
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->city = $city;
        $this->postCode = $postCode;
    }

    public function getLine1() : string
    {
        return $this->line1;
    }

    public function getLine2() : string
    {
        return $this->line2;
    }

    public function getCity() : string
    {
        return $this->city;
    }

    public function getPostCode() : string
    {
        return $this->postCode;
    }
}
