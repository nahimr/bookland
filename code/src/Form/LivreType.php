<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Isbn;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\Range;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn', null, [
                'label' => 'ISBN',
                'constraints' => [new Isbn([
                    'type' => 'isbn13',
                    'isbn13Message' => 'Ce n\'est pas un ISBN-13',
                ])]
            ])
            ->add('titre', null, ['label' => 'Titre'])
            ->add('nbpages', null, [
                'label' => 'Nombre de pages',
                'attr' => [
                    'min' => 0,
                ],
                'constraints' => [new GreaterThan([
                    'value' => 0,
                    'message' => 'Le livre doit avoir au moins une page',
                ])],
            ])
            ->add('date_de_parution', null, [
                'label' => 'Date de parution',
                'html5' => false,
                'widget' => "single_text",
                'constraints' => [new LessThan([
                    'value' => 'tomorrow',
                    'message' => 'La date doit être antérieur à demain',
                ])],
            ])
            ->add('note', null, [
                'attr' => [
                    'min' => 0,
                    'max' => 20,
                ],
                'constraints' => [new Range([
                    'min' => 0,
                    'max' => 20,
                    'notInRangeMessage' => 'La note doit être entre {{ min }} et {{ max }}',
                ])],
            ])
            ->add('auteurs', EntityType::class, [
                'class' => Auteur::class,
                'multiple' => true,
                'by_reference' => false,
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'multiple' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
