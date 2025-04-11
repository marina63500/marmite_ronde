<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;





#[Route('/admin/ingredient')]
final class AdminIngredientController extends AbstractController
{
    //route pour voir tous les ingrédients
    #[Route('', name: 'app_admin_ingredient')]
    public function index(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findAll();

        return $this->render('admin_ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    // route pour voir un ingrédient(show)
    #[Route('/show/{id}', name: 'app_admin_ingredient_show')]
    public function show($id,IngredientRepository $ingredientRepository): Response
    {
        $ingredient = $ingredientRepository ->find($id);

        return $this->render('admin_ingredient/show.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }


//route pour ajouter/créer un ingrédient
    #[Route('/create', name: 'app_admin_ingredient_create')]
    public function create(EntityManagerInterface $entityManager,Request $request): Response    
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

          // Si le formulaire est valide qu'este ce qu'on fait ??
          if ($form->isSubmitted() &&  $form->isValid()){            

            $entityManager->persist( $ingredient);
            $entityManager->flush(); 
            return $this->redirectToRoute('app_admin_ingredient'); 
                         
        }
        return $this->render('admin_ingredient/create.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView()
        ]);
    }
    
    //route pour delete(supprimer) un ingredient
    #[Route('/remove/{id}', name: 'app_admin_ingredient_remove')]
    public function remove($id,EntityManagerInterface $entityManager,IngredientRepository $ingredientRepository): Response    
    {
       $ingredient = $ingredientRepository->find($id);
       $entityManager->remove($ingredient);         
       $entityManager->flush();               
   
        return $this->redirectToRoute('app_admin_ingredient');       
    }

    //route pour edit(modifier) un ingredient
    #[Route('/edit/{id}', name: 'app_admin_ingredient_edit')]
    public function edit($id,EntityManagerInterface $entityManager,
    IngredientRepository $ingredientRepository,request $request): Response    
    {
       $ingredient = $ingredientRepository->find($id);
        $form = $this->createForm(IngredientType::class,$ingredient);   
        $form->handleRequest($request);

          if ($form->isSubmitted() &&  $form->isValid()){        
             $entityManager->persist( $ingredient);
             $entityManager->flush(); 

            return $this->redirectToRoute('app_admin_ingredient');              
        }
        return $this->render('admin_ingredient/edit.html.twig',[
            'ingredient' => $ingredient,     
            'form' => $form->createView()
        ]); 
    }
};