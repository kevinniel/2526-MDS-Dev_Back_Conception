<?php

final class Test
{

    public static int $cpt = 0;

    public function __construct()
    {
        self::$cpt += 1;
    }

}


// je veux afficher $a

var_dump(Test::$cpt);

new Test();

var_dump(Test::$cpt);