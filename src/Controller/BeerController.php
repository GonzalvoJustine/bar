<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Country;
use App\Repository\BeerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/beer")
 */
class BeerController extends AbstractController
{
    /**
     * @Route("/{id}", name="beer_show", methods={"GET"})
     */
    public function show(Beer $beer): Response
    {
        return $this->render('beer/show.html.twig', [
            'beer' => $beer,
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
