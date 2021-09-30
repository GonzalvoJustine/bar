<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Statistic;
use App\Form\BeerScoreType;
use App\Repository\BeerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/beer")
 */
class BeerController extends AbstractController
{
    /**
     * @Route("/{id}", name="beer_show")
     */
    public function show(Beer $beer, Request $request, EntityManagerInterface $manager): Response
    {
        $statistic = new Statistic();

        $scoreForm = $this->createForm(BeerScoreType::class, $statistic)->handleRequest($request);

        if ($scoreForm->isSubmitted() && $scoreForm->isValid()){
            $beer_id = $beer->getId();

            $statistic = $scoreForm->getData();

            $manager->persist($statistic);

            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('beer/show.html.twig', [
            'beer' => $beer,
            'form' => $scoreForm->createView()
        ]);
    }

    /**
     * @Route("/country/{id}", name="show_country_beer")
     */
    public function showBeerByCountry(Country $country): Response
    {
        return $this->render('country/index.html.twig', [
            'beers' => $country->getBeers() ?? [],
            'title' => $country->getName()
        ]);
    }
}
