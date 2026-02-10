<?php

// Exemple de 💩 par excellence : le if/else infernal 😈

class DiscountService
{
    public function calculate(string $type, float $amount): float
    {
        if ($type === 'regular') {
            return $amount * 0.9;
        }

        if ($type === 'vip') {
            return $amount * 0.8;
        }

        if ($type === 'partner') {
            return $amount * 0.7;
        }

        return $amount;
    }
}

/*
Les problèmes de ce code : 

- A chaque nouveau type -> on doit modifier la classe
- Un risque de casser l'existant
- Classe non stable
- On doit refaire les tests en permanence

*/


// LA SOLUTION

// Abstraction
interface DiscountStrategyInterface
{
    public function apply(float $amount): float;
}

// Implémentation
class RegularDiscount implements DiscountStrategyInterface
{
    public function apply(float $amount): float
    {
        return $amount * 0.9;
    }
}

class VipDiscount implements DiscountStrategyInterface
{
    public function apply(float $amount): float
    {
        return $amount * 0.8;
    }
}

class PartnerDiscount implements DiscountStrategyInterface
{
    public function apply(float $amount): float
    {
        return $amount * 0.7;
    }
}

class BlackFridayDiscount implements DiscountStrategyInterface
{
    public function apply(float $amount): float
    {
        return $amount * 0.5;
    }
}



// On refait le service, mais on le ferme aux modifications 

class DiscountService
{
    public function __construct(
        private DiscountStrategyInterface $strategy
    ) {}

    public function calculate(float $amount): float
    {
        return $this->strategy->apply($amount);
    }
}
