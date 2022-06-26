<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\Dish1Type;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dish_menu/edit')]
class DishMenuEditController extends AbstractController
{
    #[Route('/', name: 'app_dish_menu_edit_index', methods: ['GET'])]
    public function index(DishRepository $dishRepository): Response
    {
        return $this->render('dish_menu_edit/index.html.twig', [
            'dishes' => $dishRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dish_menu_edit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DishRepository $dishRepository): Response
    {
        $dish = new Dish();
        $form = $this->createForm(Dish1Type::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dishRepository->add($dish, true);

            return $this->redirectToRoute('app_dish_menu_edit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dish_menu_edit/new.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dish_menu_edit_show', methods: ['GET'])]
    public function show(Dish $dish): Response
    {
        return $this->render('dish_menu_edit/show.html.twig', [
            'dish' => $dish,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dish_menu_edit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dish $dish, DishRepository $dishRepository): Response
    {
        $form = $this->createForm(Dish1Type::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dishRepository->add($dish, true);

            return $this->redirectToRoute('app_dish_menu_edit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dish_menu_edit/edit.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dish_menu_edit_delete', methods: ['POST'])]
    public function delete(Request $request, Dish $dish, DishRepository $dishRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dish->getId(), $request->request->get('_token'))) {
            $dishRepository->remove($dish, true);
        }

        return $this->redirectToRoute('app_dish_menu_edit_index', [], Response::HTTP_SEE_OTHER);
    }
}
