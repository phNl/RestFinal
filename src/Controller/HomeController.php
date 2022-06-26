<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(DishRepository $dishRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'dish' => $dishRepository->find(1),
        ]);
    }
}
