<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class BeerFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        // on fixe le nombre de bière à insérer dans les variables d'environnements
        $count = $_ENV["APP_FIXTURES_NB_BEERS"] ?? 20;

        $countries = $manager->getRepository(Country::class)->findAll();

        $catNormals = $manager->getRepository(Category::class)->findByTerm('normal');
        $catSpecials = $manager->getRepository(Category::class)->findByTerm('special');

        while($count > 0){
            shuffle($countries);
            shuffle($catNormals);

            $beer = new Beer();
            $beer   ->setName($faker->word)
                    ->setPublishedAt($faker->dateTime())
                    ->setDescription($faker->text(rand(200, 500)))
                    ->setCountry($countries[0])
                    ->setPrice($faker->randomNumber(2));

            $count--;
            $manager->persist($beer);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}