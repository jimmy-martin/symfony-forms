<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

class OpinionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $missingMessage = 'Le champ {{ label }} doit être rempli !';
        $minMessage = 'Le champ doit contenir au moins {{ limit }} caractères';
        $maxMessage = 'Le champ ne doit pas contenir plus de {{ limit }} caractères';

        $builder
            ->add('lastname', null, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ])
                ],
            ])
            ->add('firstname', null, [
                'label' => 'Prénom',
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                    new Length([
                        'min' => 100,
                        'minMessage' => $minMessage,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                    new Email([
                        'message' => 'L`email {{ value }} n\'est pas valide !',
                        'mode' => 'html5',
                    ]),
                ],
            ])
            ->add('age', IntegerType::class, [
                'attr' => [
                    'min' => 7,
                    'max' => 77,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                    new Length([
                        'min' => 8,
                        'max' => 16,
                        'minMessage' => $minMessage,
                        'maxMessage' => $maxMessage,
                    ]),
                ],
            ])
            ->add('website', UrlType::class, [
                'label' => 'Site web',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                    new Url([
                        'message' => 'L\'url {{ value }} n\'est pas valide !',
                    ]),
                ],
            ])
            ->add('opinion', ChoiceType::class, [
                'label' => 'Avis',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
                'choices' => [
                    'Excellent' => 1,
                    'Très bon' => 2,
                    'Bon' => 3,
                    'Peut mieux faire' => 4,
                    'A éviter' => 5,
                ],
            ])
            ->add('emotion', ChoiceType::class, [
                'label' => 'Ce film vous a fait',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
                'choices' => [
                    'Rire' => 1,
                    'Pleurer' => 2,
                    'Réfléchir' => 3,
                    'Dormir' => 4,
                    'Rêver' => 5,
                ],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('date', DateType::class, [
                'label' => 'Vous avez vu le film le',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
                'widget' => 'single_text',
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo du cinéma ou de la salle',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
