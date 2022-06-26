<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishMenuController extends AbstractController
{
    #[Route('/dish_menu', name: 'app_dish_menu')]
    public function index(Request $request, DishRepository $dishRepository): Response
    {
        return $this->render('dish_menu/index.html.twig', [
            'dishes' => $dishRepository->findAll(),
        ]);
    }
}
