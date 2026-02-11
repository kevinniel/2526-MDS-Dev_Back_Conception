<?php

// disclaimer : rempli de M**** pour faire nos tests

// $annee = 20;

// echo('<pre>');
// echo('<code>');
// var_dump($annee);
// echo('</code>');
// echo('</pre>');


// if ($annee >= 18) {
//     return "majeur";
// }


function addition($a, $b, $c=0)
{
    return $a+$b+$c;
}


function add4times($a, $b) {
    $r = addition($a, $b);
    $r += addition($a, $b);
    $r += addition($a, $b);
    $r += addition($a, $b);
    return $r;
}




addition(2, 3);







addition(2, 4);



// 3000 fichiers qui font "addition()"

// Nouveau besoin

// additionner 3 chiffres !



















