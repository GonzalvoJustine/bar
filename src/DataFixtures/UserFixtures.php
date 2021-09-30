<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Config\Security\PasswordHasherConfig;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $count = $_ENV["APP_FIXTURES_NB_USER"] ?? 1;


        $adminUser = new User();
        $adminUser
            ->setEmail('b@b.b')
            ->setPassword($this->passwordHasher->hashPassword(
                $adminUser,
                'bbbbbb'
            ))
            ->setRoles(['ROLE_USER'])
            ;
        $manager->persist($adminUser);

        while($count > 0){
            $user = new User();
            $user   ->setEmail('a@a.a')
                    ->setPassword($this->passwordHasher->hashPassword(
                        $user,
                        'aaaaaa'
                    ))
                    ->setRoles(['ROLE_ADMIN']);

            $count--;
            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
