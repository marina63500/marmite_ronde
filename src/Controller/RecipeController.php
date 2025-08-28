<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use App\Repository\CommentRepository;
use App\Repository\DifficultRepository;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;



#[Route('/recipe')]
final class RecipeController extends AbstractController
{
    //route toutes les recettes
    #[Route('', name: 'recipe_index')]
    public function index(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,

        ]);
    }
    //route une recette
    #[Route('/show/{id}', name: 'recipe_show')]
    public function show(
        Recipe $recipe,
        RecipeRepository $recipeRepository,
        IngredientRepository $ingredientRepository,
        CommentRepository $commentRepository
    ): Response {
        // $ingredients = $ingredientRepository->findAll();
        // $comments = $commentRepository -> findAll();
        // $comments = $commentRepository->findBy(['recipe' => $recipe], ['createdAt' => 'DESC']);

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            // 'ingredients' => $ingredients,
            // 'comments' => $comments,

        ]);
    }
    // route par difficulté
    #[Route('/difficult/{id}', name: 'recipe_difficult')]
    public function difficult($id, DifficultRepository $difficultRepository): Response
    {
        $difficult = $difficultRepository->find(id: $id);
        $difficult = $difficultRepository->findAll();
        return $this->render('recipe/difficult.html.twig', [
            'difficult' => $difficult,

        ]);
    }

    //créer une recette
    // #[IsGranted('ROLE_USER')] // soit granded soit access control pour que seulement utilisateur co puisse créer une recette
    #[Route('/add', name: 'recipe_add')]
    public function addrecipe(EntityManagerInterface $entityManager, Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        // Si le formulaire est valide qu'este ce qu'on fait ??
        if ($form->isSubmitted() &&  $form->isValid()) {
            // il FAUT un User
            $user = $this->getUser();

            $recipe->setUser($user);


            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_index');
        }
        // ICI on est 
        // La recette a été créée MAINTENANT (now ??)
        // La recette a été créée par ????
        // ENREGISTRER       

        return $this->render('recipe/add.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

    // recette de l'user connecté et du admin
    #[Route('/user/recipes', name: 'user_recipes')]
    public function myRecipes(RecipeRepository $repo, Security $security): Response
    {
        $user = $security->getUser();
        $recipes = $repo->findBy(['user' => $user]);

        return $this->render('recipe/my_recipes.html.twig', [
            'recipes' => $recipes,
            'user' => $user
        ]);
    }
}
