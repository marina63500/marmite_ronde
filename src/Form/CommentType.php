<?php

namespace App\Form;

use App\Entity\Comment;
use App\Entity\Recipe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updateAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Entrez votre commentaire ici...',
                ],
            ])
//je mets en commentaire la recette et le user car je ne veux pas que ca demande a l utilisateur de choisir son nom et sa recette,ca doit etre automatique

            // ->add('recipe', EntityType::class, [
            //     'class' => Recipe::class,
            //     'choice_label' => 'title',
            // ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'pseudo',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
