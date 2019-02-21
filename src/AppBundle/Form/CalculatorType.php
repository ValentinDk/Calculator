<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CalculatorType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('material', ChoiceType::class,
                [
                    'choices'=>
                        [
                            'Плёнка' => 'skin',
                            'Ткань' => 'cloth'
                        ],
                    'label'  => 'Материал',
                ])
            ->add('texture', ChoiceType::class,
                [
                    'choices'=>
                        [
                            'Сатиновая' => 'satin',
                            'Глянцевая' => 'gloss',
                            'Матовая' => 'matt'
                        ],
                    'label'  => 'Фактура',
                ])
            ->add('ceilingLevel', IntegerType::class,
                [
                    'label'  => 'Кол-во уровней потолка'
                ])
            ->add('length', NumberType::class,
                [
                    'label'  => 'Длина'
                ])
            ->add('width', NumberType::class,
                [
                    'label'  => 'Ширина'
                ])
            ->add('light', IntegerType::class,
                [
                    'label'  => 'Кол-во источников света'
                ])
            ->add('calculate', SubmitType::class,
                [
                    'label'  => 'Подсчитать'
                ]);
    }
}