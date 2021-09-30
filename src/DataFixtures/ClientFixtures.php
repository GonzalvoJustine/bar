<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Config\Security\PasswordHasherConfig;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ClientFixtures extends Fixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $count = $_ENV["APP_FIXTURES_NB_CLIENTS1"] ?? 10;

        while($count > 0){
            $client = new Client();
            $client   ->setEmail($faker->email)
                    ->setWeight($faker->randomNumber(2))
                    ->setName($faker->firstname)
                    ->setNumberBeer(rand(0, 15))
            ;

            $count--;
            $manager->persist($client);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
