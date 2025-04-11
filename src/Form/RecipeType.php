<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Entity\Difficult;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class,[
                'label' => 'Titre de la recette',
                'required' => true
            ])
            ->add('image',TextType::class,[
                'label' => 'Image',
                'required' => true
            ])
            ->add('duration',NumberType::class,[
                'label' => 'durée :',
                'required' => true
            ])
            ->add('nbPeople',NumberType::class,[
                'label' => 'nombre de perssonnes',
                'required' => true
            ])
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updatedAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('content',TextareaType::class,[
                'label' => 'description de la recette',
                'required' => true,
                'attr' => ['placeholder' => 'Entrez votre description']
            ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
                
            ])
          
            ->add('difficult', EntityType::class, [
                'class' => Difficult::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
