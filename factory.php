<?php

interface Toto {}

class ArticleTable implements Toto {}
class VoitureTable implements Toto {}
class UtilisateurTable implements Toto {}


function create($a) {
    if($a == 'article') {
        return new ArticleTable();
    } elseif ($a == 'voiture') {
        return new VoitureTable();
    } elseif ($a == 'utilisateur') {
        return new UtilisateurTable();
    }
}

create('voiture');
create('article');
create('utilisateur');

class Factory
{
    public static function create(Toto $a)
    {
        $classname = ucfirst($a) . 'Table';
        return new $classname();
    } 
}

Factory::create('voiture');
Factory::create('article');
Factory::create('utilisateur');