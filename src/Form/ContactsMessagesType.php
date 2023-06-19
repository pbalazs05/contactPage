<?php

namespace App\Form;

use App\Entity\ContactsMessages;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactsMessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType ::class,[
                'required' => true,
                'label' =>'Neved',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control', 'style'=> 'margin-bottom:2em']
            ])
            ->add('email', EmailType::class,[
                'required' => true,
                'label' =>'E-mail címed',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-custom','style'=> 'margin-bottom:2em']
            ])
            ->add('messageText', TextareaType::class, [
                'required' => true,
                'label'=> 'Üzenet szövege',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-custom', 'style'=> 'margin-bottom:2em']
            ])
            ->add('save', SubmitType::class, ['label'=> 'Küldés', 'attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactsMessages::class,

        ]);
    }

}
