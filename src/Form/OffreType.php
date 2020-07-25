<?php

namespace App\Form;

use App\Entity\Competences;
use App\Entity\Domaine;
use App\Entity\Niveau;
use App\Entity\Offres;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control']])

            ->add('begin_at', DateType::class, ['label' => 'date de début'])
            ->add('duree', IntegerType::class, ['label' => 'durée en année'])
            ->add('description', TextareaType::class, ['attr' => ['class' => 'form-control']])
            ->add('salaire', IntegerType::class, ['label' => 'salaire', 'required' => false])

            ->add('image', FileType::class,['label' => 'photo', 'mapped'=>false, 'required'=>false])
            ->add('ville', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('domaine', EntityType::class,[ 'expanded' => false,
                'multiple' => false,  'class'=>Domaine::class, 'choice_label'=>'name', 'attr' => ['class' => 'form-control']])
            ->add('competences',  EntityType::class,[ 'expanded' => true,
                'multiple' => true, 'class'=>Competences::class, 'choice_label'=>'name', 'attr' => ['class' => 'form-check']])
            ->add('niveau', EntityType::class,[ 'expanded' => false,
                'multiple' => false, 'class'=>Niveau::class, 'choice_label'=>'name', 'attr' => ['class' => 'form-control']])

            ->add('publier',SubmitType::class, ['attr' =>  ['class' => 'btn btn-primary my-2']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offres::class,
        ]);
    }
}
