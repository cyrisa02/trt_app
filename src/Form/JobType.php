<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Recruiter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Titre '

            ])
            ->add('workPlace',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Lieu '

            ])
            ->add('description',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description du poste '

            ])
            ->add('schedule',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Renseignez  les horaires '

            ])
            ->add('salary',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Renseignez le salaire annuel '

            ])
            ->add('isVisible',CheckboxType::class, [
                //'mapped' => true,
                'required' => false,
                'label' => 'Validation de l\'annonce.',
                'label_attr' => [
                    'class' => 'form-label  mt-4'
                ],
                'attr' => [
                    'class' => 'd-flex justify-content-between',
                ],
            ])
            // ->add('recruiter', EntityType::class, [
            //     'class'=>Recruiter::class,
            //     'placeholder'=>'Reconfirmer votre nom par rapport à la liste',
            //     'attr' => [
            //         'class' => 'form-control '
            //     ],
            //     'label' => 'Merci de confirmer le nom du recruteur. ',
                
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}