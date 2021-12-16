<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class AuteurIncrementNoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('incrementNote', NumberType::class, [
                'label' => 'Incrémenter les notes de tout les livres',
                'attr' => [
                    'min' => 1,
                    'max' => 20,
                    'value' => 1,
                ],
                "html5" => true,
                "mapped" => true,
                "required"   => false,
            ])
        ;
    }

}