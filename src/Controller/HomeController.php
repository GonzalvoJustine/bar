<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\BeerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="beer", methods={"GET"})
     */
    public function index(BeerRepository $beerRepository): Response
    {
        return $this->render('beer/index.html.twig', [
            'beers' => $beerRepository->findAll(),
            'title' => "Page d'accueil"
        ]);
    }

    public function mainMenu(string $routeName, int $catId = null): Response
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findBy(['term' => 'normal']);

        return $this->render('partials/navigation.html.twig', [
            'route_name' => $routeName,
            'category_id' => $catId,
            'categories' => $categories
        ]);
    }
}
