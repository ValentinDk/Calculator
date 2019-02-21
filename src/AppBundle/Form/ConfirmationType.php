<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;

class ConfirmationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                [
                    'label' => 'Ваше имя',
                    'attr' =>
                        [
                            'minlength' => 2,
                            'maxlength' => 15,
                        ]
                ])
            ->add('email', EmailType::class,
                [
                    'label' => 'Эл. адрес'
                ])
            ->add('telephone', TelType::class,
                [
                    'label' => 'Телефон +375',
                    'attr' =>
                        [
                            'minlength' => 9,
                            'maxlength' => 9,
                        ]
                ])
            ->add('confirmation', SubmitType::class,
                [
                    'label'  => 'Подтвердить'
                ]);
    }
}