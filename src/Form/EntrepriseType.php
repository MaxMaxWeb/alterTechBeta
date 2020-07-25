<?php

namespace App\Form;

use App\Entity\Domaine;
use App\Entity\Entreprises;
use App\Entity\Niveau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('name',TextType::class, ['attr' => ['class' => 'form-control',]])


            ->add('ville',TextType::class, ['attr' => ['class' => 'form-control']])

            ->add('domaine', EntityType::class,[ 'expanded' => false,
                'multiple' => false,  'class'=>Domaine::class, 'choice_label'=>'name', 'attr' => ['class' => 'form-control']])
            ->add("inscrire", SubmitType::class, ['attr' =>  ['class' => 'btn btn-primary my-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprises::class,
        ]);
    }
}
