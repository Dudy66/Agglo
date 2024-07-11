<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManagerInterface;

class RegistrationFormType extends AbstractType
{
    /**
     * @Assert\Email()
     */
    public $email;

    public function isValidEmail(EntityManagerInterface $entityManager): bool
    {
        $existingUser = $entityManager->getRepository(Users::class)->findOneBy(['email' => $this->email]);

        return $existingUser === null;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prenom :',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pierre',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Dupont',
                ],
            ])
            ->add('email', TextType::class, [
                'label' => 'Email :',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pierre_Dupont@live.fr',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse :',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '135 rue du Renard 34000 Montpellier',
                ],
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance :',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '09/07/1988',
                ],
                'constraints' => [
                    new LessThan([
                        'value' => '-18 years',
                        'message' => 'Vous devez avoir au moins 18 ans pour vous inscrire.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [

                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control',
                    'placeholder' => '********',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',

                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo de profil :',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les Conditions générales.',
                'mapped' => false,
                'attr' => [
                    'class' => 'form-check-label',
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
