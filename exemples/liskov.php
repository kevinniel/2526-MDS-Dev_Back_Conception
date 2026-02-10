<?php

class Bird
{
    public function fly(): void
    {
        echo "Je vole";
    }
}

class Penguin extends Bird
{
    public function fly(): void
    {
        throw new Exception("Un pingouin ne vole pas");
    }
}

function makeBirdFly(Bird $bird): void
{
    $bird->fly();
}

// Le déclenchement va générer une erreur.
makeBirdFly(new Penguin());


// SOLUTION Comment régler ce souci là 

interface FlyingBirdInterface
{
    public function fly(): void;
}

abstract class Bird
{
    public function eat(): void
    {
        echo "Je mange";
    }
}

class Sparrow extends Bird implements FlyingBirdInterface
{
    public function fly(): void
    {
        echo "Je vole";
    }
}

class Penguin extends Bird
{
    // pas de fly(), et c’est OK
}

function makeBirdFly2(FlyingBirdInterface $bird): void
{
    $bird->fly();
}

// OK (pas boom)
makeBirdFly2(new Sparrow());



