<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\Client;
use App\Entity\Statistic;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class StatisticFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $clients = $manager->getRepository(Client::class)->findAll();
        $beers = $manager->getRepository(Beer::class)->findAll();

        $count = $_ENV["APP_FIXTURES_NB_STATISTICS"] ?? 101;

        while($count > 0){

            shuffle($clients);
            shuffle($beers);

            $statistic = new Statistic();
            $statistic  ->setClient($clients[0])
                        ->setBeer($beers[0])
                        ->setScore(rand(1,10));

            $count--;
            $manager->persist($statistic);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}
