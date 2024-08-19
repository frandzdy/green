<?php

namespace App\DataFixtures\Init;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordEncoder,
    ) {
    }

    public static function getGroups(): array
    {
        return ['init'];
    }

    /**
     * <@inheritDoc>.
     */
    public function load(ObjectManager $manager): void
    {
        $user = $this->createUser('contributor@demo.fr', 'Frandzdy', 'Sanon', true);
        $manager->persist($user);

        $manager->flush();
    }

    private function createUser(string $email, string $firstname, string $lastname, bool $activate): User
    {
        $user = new User();

        return $user->setEmail($email)
            ->setFirstname($firstname)
            ->setPassword($this->passwordEncoder->hashPassword($user, 'contributorpass'))
            ->setRoles([User::ROLE_SUPER_ADMIN])
            ->setLastname($lastname)
            ->setActivate($activate);
    }
}
