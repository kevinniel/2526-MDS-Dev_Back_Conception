<?php 

class UserRepository
{
    public function findById(int $id): array
    {
        return ['id' => $id, 'name' => 'Kevin'];
    }
}

class UserService
{
    private UserRepository $repo;

    public function __construct()
    {
        $this->repo = new UserRepository();
    }

    public function getUser(int $id): array
    {
        return $this->repo->findById($id);
    }
}

/*

Questions :

1. Peut-on tester UserService sans toucher à la BDD ?
2. est-ce qu'on peut changer la source de données ?
3. Qui crée la dépendance ?


Réponse : 

Ici, on a un mauvais Design.

*/

interface UserRepositoryInterface
{
    public function findById(int $id): array;
}

class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): array
    {
        return ['id' => $id, 'name' => 'Kevin'];
    }
}

class FakeUserRepository implements UserRepositoryInterface
{
    public function findById(int $id): array
    {
        return ['id' => 42, 'name' => 'Test User'];
    }
}

class UserService
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getUser(int $id): array
    {
        return $this->repo->findById($id);
    }
}

// $repo = new UserRepository();
$repo = new FakeUserRepository();
$service = new UserService($repo);

$user = $service->getUser(1);

/*

Sans DI : Je crée ce dont j'ai besoin
Avec DI : On me donne ce dont j'ai besoin

*/