<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



#[Route('/recipe')]
final class RecipeController extends AbstractController
{
    //route toutes les recettes
    #[Route('', name: 'recipe_index')]
    public function index(): Response
    {
        return $this->render('recipe/index.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }
    //route une recette
    #[Route('/show/{id}', name: 'recipe_show')]
    public function show(): Response
    {
        return $this->render('recipe/show.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }
    // route par difficulté
    #[Route('difficult/{id}', name: 'recipe_difficult')]
    public function difficult(): Response
    {
        
        return $this->render('recipe/difficult.html.twig', [
            'controller_name' => 'RecipeController',
        ]);
    }
}
