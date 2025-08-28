<?php

namespace App\Controller;

use App\Entity\Recipe;
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
        $comments =  $commentRepository->findAll();

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }
    //route pour ajouter un commentaire
    #[Route('/create/{id}', name: 'comment_create')]
    public function create(Recipe $recipe, EntityManagerInterface $entityManager, Request $request): Response
    {
        // recupere un utilisateur
        $user = $this->getUser();
        // renvoie le user a se connecter s il ne l est pas pour ecrire un commentaire
        if ($user === null) {
            // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        $comment = new Comment();  //la date est mise a jour automatiquement ici
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() &&  $form->isValid()) {
            $comment->setUser($this->getUser()); // On récupère l'utilisateur connecté et on le défini en tant qu'auteur

            $comment->setRecipe($recipe);

            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('comment_index');
        }
        return $this->render('comment/createComment.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }
    //pour modifier un commentaire
    #[Route('/edit/{id}', name: 'comment_edit')]
    public function edit(
        $id,
        EntityManagerInterface $entityManager,
        CommentRepository $commentRepository,
        Request $request
    ): Response {
        $comment = $commentRepository->find($id);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() &&  $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('comment_index');
        }

        return $this->render('comment/index.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }
}
