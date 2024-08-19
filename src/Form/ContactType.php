<?php

namespace App\Form;

use App\Enum\ContactSubject;
use App\Model\ContactModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Prénom',
                    'attr' => [
                        'maxlength' => 100,
                        'placeholder' => 'Prénom *',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating mb-3',
                    ],
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'Nom',
                    'attr' => [
                        'maxlength' => 100,
                        'placeholder' => 'Nom',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating mb-3',
                    ],
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'E-mail',
                    'attr' => [
                        'maxlength' => 255,
                        'placeholder' => 'E-mail',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating mb-3',
                    ],
                ]
            )
            ->add(
                'subject',
                ChoiceType::class,
                [
                    'label' => false,
                    'attr' => ['class' => 'custom-select'],
                    'choices' => array_flip(ContactSubject::getAvailableContactSubjects()),
                    'placeholder' => '-- Sélectionnez un sujet --',
                    'row_attr' => [
                        'class' => 'form-floating mb-3',
                    ],
                ]
            )
            ->add(
                'message',
                TextareaType::class,
                [
                    'label' => 'Laissez nous un message',
                    'attr' => [
                        'style' => 'height: 200px;resize:none;',
                        'maxlength' => 400,
                        'placeholder' => 'Laissez nous un message *',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating mb-3',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => ContactModel::class,
            ]
        );
    }
}
