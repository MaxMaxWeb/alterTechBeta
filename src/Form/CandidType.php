<?php



namespace App\Form;

use App\Entity\Candidatures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cv', FileType::class, ['label' => 'cv', 'mapped' => false, 'required' => true])
            ->add('lettredemotiv', FileType::class, ['label' => 'lettre de motivation', 'mapped' => false, 'required' => false])
            ->add('message', TextareaType::class, ['label' => 'Message de motivation', 'mapped' => false, 'required' => false])

            ->add('publier', SubmitType::class, ['attr' => ['class' => 'btn btn-primary my-2']]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidatures::class,
        ]);
    }
}

