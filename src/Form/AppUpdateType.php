<?php

namespace App\Form;

use App\Entity\Apprentis;
use App\Entity\Competences;
use App\Entity\Niveau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('description', TextareaType::class, ['attr' => ['class' => 'form-control']])



            ->add('ecole', TextType::class,[ 'attr' => ['class' => 'form-control']])
            ->add('ville', TextType::class,[ 'attr' => ['class' => 'form-control']])



            ->add('niveau', EntityType::class,[ 'expanded' => false,
                'multiple' => false, 'class'=>Niveau::class, 'choice_label'=>'name', 'attr' => ['class' => 'form-control']])

            ->add('competences',  EntityType::class,[ 'expanded' => true,
                'multiple' => true, 'class'=>Competences::class, 'choice_label'=>'name', 'attr' => ['class' => 'form-check']])



            ->add("Modifier", SubmitType::class, ['attr' =>  ['class' => 'btn btn-primary my-2']])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apprentis::class,
        ]);
    }
}
