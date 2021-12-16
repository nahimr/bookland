<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class AuthorFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('threeDistinctBooks', CheckboxType::class, [
                "label" => "Auteur ayant écrit plus de 3 livres différents",
                "required" => false,
            ])
        ;
    }
}