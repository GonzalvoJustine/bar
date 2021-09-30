<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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
