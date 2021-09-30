<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/beer", name="beer")
 */
class BeerController extends AbstractController
{
    /**
     * @Route("/", name="beer")
     */
    public function index(): Response
    {
        return $this->render('beer/index.html.twig', [
            'controller_name' => 'BeerController',
        ]);
    }
}
