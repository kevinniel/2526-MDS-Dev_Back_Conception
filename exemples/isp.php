<?php

// LA MAUVAISE MANIERE

// exemple d'interface générique pour un utilisateur
interface UserInterface
{
    public function login(): void;
    public function logout(): void;
    public function createUser(): void;
    public function deleteUser(): void;
    public function banUser(): void;
}

// On crée la classe de l'utilisateur
class SimpleUser implements UserInterface
{
    public function login(): void {}
    public function logout(): void {}

    public function createUser(): void
    {
        throw new Exception("Non autorisé");
    }

    public function deleteUser(): void
    {
        throw new Exception("Non autorisé");
    }

    public function banUser(): void
    {
        throw new Exception("Non autorisé");
    }
}


// LA BONNE MANIERE


interface AuthInterface
{
    public function login(): void;
    public function logout(): void;
}

interface UserManagementInterface
{
    public function createUser(): void;
    public function deleteUser(): void;
    public function banUser(): void;
}

// Implémentation de l'utilisateur simple 

class SimpleUser implements AuthInterface
{
    public function login(): void
    {
        // login simple
    }

    public function logout(): void
    {
        // logout
    }
}

class AdminUser implements AuthInterface, UserManagementInterface
{
    public function login(): void {}
    public function logout(): void {}

    public function createUser(): void {}
    public function deleteUser(): void {}
    public function banUser(): void {}
}




