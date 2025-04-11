<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




 #[Route('/comment')]
final class CommentController extends AbstractController
{
    #[Route('', name: 'comment_index')]
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $ $commentRepository->findAll(); 

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }
    //route pour ajouter un commentaire
    #[Route('/create', name: 'comment_create')]
    public function create(EntityManagerInterface $entityManager,Request $request): Response
    {
        $comment= new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() &&  $form->isValid()){            

            $entityManager->persist( $comment);
            $entityManager->flush(); 
            return $this->redirectToRoute('comment_index');
        }
            return $this->render('comment/index.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }
    //pour modifier un commentaire
    #[Route('/edit/{id}', name: 'comment_edit')]
    public function edit($id,EntityManagerInterface $entityManager,
    CommentRepository $commentRepository,Request $request): Response
    {
        $comment = $commentRepository->find($id);
        $form = $this->createForm(CommentType::class,$comment);   
        $form->handleRequest($request);

          if ($form->isSubmitted() &&  $form->isValid()){        
             $entityManager->persist( $comment);
             $entityManager->flush(); 

            return $this->redirectToRoute('comment_index'); 
          } 

        return $this->render('comment/index.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }
}
