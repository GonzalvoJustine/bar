<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class CategoryFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        // catégories normals
        $categoriesNormals = ['blonde', 'brune', 'blanche'];

        // catégories specials
        $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'] ;

        foreach( $categoriesNormals as $normal ) {
            $category = new Category();
            $category   ->setName($normal)
                        ->setDescription($faker->text);
            // Terme de la catégorie par défaut normal
            $manager->persist($category);
        }

        foreach( $categoriesSpecials as $special ) {
            $category = new Category();
            $category   ->setName($special)
                        ->setDescription($faker->text)
                        ->setTerm('special');

            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}
