<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Url;

class MovieReviewType extends AbstractType
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
                'label' => 'Message',
                'constraints' => [
                    new Length([
                        'min' => 100,
                        'minMessage' => $minMessage,
                    ]),
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
            ])

            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'constraints' => [
                    new Email([
                        'message' => 'L`email {{ value }} n\'est pas valide !',
                        'mode' => 'html5',
                    ]),
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
            ])

            ->add('age', IntegerType::class, [
                'label' => 'Âge',
                'attr' => [
                    'min' => 7,
                    'max' => 77,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                    new Range([
                        'min' => 7,
                        'max' => 77,
                        'notInRangeMessage' => 'La valeur doit être entre {{ min }} et {{ max }}.'
                    ])
                ],
            ])

            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'max' => 16,
                        'minMessage' => $minMessage,
                        'maxMessage' => $maxMessage,
                    ]),
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
            ])

            ->add('url', UrlType::class, [
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

            ->add('review', ChoiceType::class, [
                'label' => 'Avis',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
                'choices' => [
                    'Excellent' => 5,
                    'Très bon' => 4,
                    'Bon' => 3,
                    'Peut mieux faire' => 2,
                    'A éviter' => 1,
                ],
                // On peut rajouter un 'required' => false afin de  
                // rajouter une ligne vide au cas où je ne sélectionne rien
                'required' => false
            ])

            ->add('feeling', ChoiceType::class, [
                'label' => 'Ce film vous a fait',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
                'choices' => [
                    'Rire' => 'laugh',
                    'Pleurer' => 'cry',
                    'Réfléchir' => 'think',
                    'Dormir' => 'sleep',
                    'Rêver' => 'dream',
                ],
                'expanded' => true,
                'multiple' => true,
            ])

            ->add('watchedAt', DateType::class, [
                'label' => 'Vous avez vu le film le',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
                'widget' => 'single_text',
            ])

            ->add('file', FileType::class, [
                'label' => 'Photo du cinéma ou de la salle',
                'constraints' => [
                    new NotBlank([
                        'message' => $missingMessage,
                    ]),
                ],
            ])

            // Un CheckboxType est un FormType qui permet de ne générer qu'une seul checkbox
            // Quand on l'utilise, on souhaite savoir si elle est cochée ou non
            ->add('robotCheck', CheckboxType::class, [
                'label' => 'Je ne suis pas un robot',
                'required' => false,
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
