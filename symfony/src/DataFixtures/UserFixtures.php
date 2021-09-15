<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private array $users = [
        ['username' => 'asd', 'pass' => 'pass', 'roles' => ['ROLE_USER'], 'status' => true],
        ['username' => 'admin', 'pass' => 'pass', 'roles' => ['ROLE_ADMIN'], 'status' => true],
        ['username' => 'asd3', 'pass' => 'pass', 'roles' => ['ROLE_ADMIN'], 'status' => false],
        ['username' => 'superadmin', 'pass' => 'pass', 'roles' => ['ROLE_SUPER_ADMIN'], 'status' => true],
        ['username' => 'user', 'pass' => 'pass', 'roles' => ['ROLE_SUPER_ADMIN'], 'status' => true],
    ];
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->users as $user) {
            $newUser = new User();

            $newUser->setUsername($user['username'])
                ->setPassword($this->passwordHasher->hashPassword($newUser, $user['pass']))
                ->setRoles($user['roles'])
                ->setStatus($user['status'])
                ->setUserTag($this->getReference($user['username'])->getId());

            $manager->persist($newUser);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
        ];
    }
}
