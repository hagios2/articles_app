<?php
declare(strict_types=1);

namespace App\Form\Type;


use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['constraints' => new NotNull()])
            ->add('email', EmailType::class, ['constraints' => new NotNull(['message' => 'Email is required'])])
            ->add('phone_number', TextType::class, ['constraints' => new NotNull()]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Customer::class, 'legacy_error_messages' => false]);
    }


}