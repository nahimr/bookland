<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn', null, ['label' => 'ISBN'])
            ->add('titre', null, ['label' => 'Titre'])
            ->add('nbpages', null, ['label' => 'Nombre de pages'])
            ->add('date_de_parution', null, [
                'label' => 'Date de parution',
                "html5" => false,
                "widget" => "single_text",
            ])
            ->add('note', null, [
                "attr" => [
                    "min" => 0,
                    "max" => 20,
                ]
            ])
            ->add('auteurs', EntityType::class, [
                'class' => Auteur::class,
                'multiple' => true,
                'by_reference' => false
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'multiple' => true,
                'by_reference' => false
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
