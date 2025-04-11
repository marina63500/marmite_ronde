<?php

namespace App\Controller;

use App\Entity\Difficult;
use App\Form\DifficultType;

use App\Repository\DifficultRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin/difficult')]
final class AdminDifficultController extends AbstractController
{
    #[Route('', name: 'admin_difficult')]
    public function index(DifficultRepository $difficultRepository): Response
    {
        $difficults = $difficultRepository->findAll();

        return $this->render('admin_difficult/index.html.twig', [
            'difficults' => $difficults,
        ]);
    }
    //route pour voir un ingredient
    #[Route('/show/{id}', name: 'admin_difficult_show')]
    public function show($id,DifficultRepository $difficultRepository): Response
    {
        $difficult = $difficultRepository->find($id);

        return $this->render('admin_difficult/show.html.twig', [
            'difficult' => $difficult,
        ]);
    }
    //route pour ajouter une difficulté
    #[Route('/create', name: 'admin_difficult_create')]
    public function create(EntityManagerInterface  $entityManager,Request $request): Response
    {
        $difficult = new Difficult();
        $form = $this->createForm(DifficultType::class, $difficult);
        $form->handleRequest($request);

          
          if ($form->isSubmitted() &&  $form->isValid()){            

            $entityManager->persist( $difficult);
            $entityManager->flush(); 
            return $this->redirectToRoute('admin_difficult'); 
        }    
        return $this->render('admin_difficult/create.html.twig', [
            'difficult' => '$difficult',
            'form' => $form->createView(),
        ]);
        }
    

    //route pour modifier une difficulté
    #[Route('/edit/{id}', name: 'admin_difficult_edit')]
        public function edit($id,EntityManagerInterface $entityManager,
         DifficultRepository $difficultRepository,Request $request): Response   
    {
        $difficult = $difficultRepository->find($id);
        $form = $this->createForm(DifficultType::class,$difficult);   
        $form->handleRequest($request);

          if ($form->isSubmitted() &&  $form->isValid()){        
             $entityManager->persist( $difficult);
             $entityManager->flush(); 

            return $this->redirectToRoute('admin_difficult');              
        }

            return $this->render('admin_difficult/edit.html.twig',[
            'difficult' => $difficult,     
            'form' => $form->createView()
        ]); 
    }
    
      //route pour supprimer un ingredient
      #[Route('/remove/{id}', name: 'admin_difficult_remove')]
        public function remove($id,DifficultRepository $difficultRepository,EntityManagerInterface $entityManager): Response
      {
        $difficult = $difficultRepository->find($id);
        $entityManager->remove($difficult);         
        $entityManager->flush();               
    
         return $this->redirectToRoute('admin_difficult'); 
      }
}
