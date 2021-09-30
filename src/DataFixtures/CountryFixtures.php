<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Country;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CountryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $countries = ['belgium', 'french', 'English', 'germany'];

        foreach($countries as $name){
            $country = new Country();
            $country    ->setName($name)
                        ->setAddress($faker->address)
                        ->setEmail($faker->email);

            $manager->persist($country);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
