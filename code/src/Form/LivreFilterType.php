<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class LivreFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'error_bubbling' => true,
            ])
            ->add('fromScore', NumberType::class, [
                "attr" => [
                    "min" => 0,
                    "max" => 20,
                    "data-action" => "livre#noteHandler",
                ],
                "label" => "Note minimum",
                "html5" => true,
                "mapped" => true,
                "required"   => false,
                'error_bubbling' => true,
            ])
            ->add('toScore', NumberType::class, [
                "attr" => [
                    "min" => 0,
                    "max" => 20,
                    "data-action" => "livre#noteHandler",
                ],
                "label" => "Note maximale",
                "html5" => true,
                "mapped" => true,
                "required" => false,
                'error_bubbling' => true,
            ])
            ->add('fromDate', DateTimeType::class, [
                "label" => "Date minimum",
                "required"   => false,
                "html5" => false,
                "widget" => "single_text",
                "format" => "yyyy-mm-dd",
                'error_bubbling' => true,
            ])
            ->add('toDate', DateTimeType::class, [
                "label" => "Date maximum",
                "required"   => false,
                "html5" => false,
                "widget" => "single_text",
                "format" => "yyyy-mm-dd",
                'error_bubbling' => true,
            ])
            ->add('distinctNationality', CheckboxType::class, [
                "label" => "Livres ayant des auteurs de différente nationalités",
                "required" => false,
                'error_bubbling' => true,
            ])
            ->add('sexualParity', CheckboxType::class, [
                "label" => "Livres ayant des auteurs avec une parité femmes/hommes (50%)",
                "required" => false,
                'error_bubbling' => true,
            ]);
    }
}