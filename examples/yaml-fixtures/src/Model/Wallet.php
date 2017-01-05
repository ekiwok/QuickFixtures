<?php

namespace Ekiwok\QuickFixtures\Examples\YML\Model;

class Wallet
{
    /**
     * @var CreditCard[]
     */
    private $cards = [];

    /**
     * @param CreditCard $card
     */
    public function addCreditCard(CreditCard $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return CreditCard[]
     */
    public function getCards()
    {
        return $this->cards;
    }
}
