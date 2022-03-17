<?php

namespace App\Form;

use App\Config\ReviewGroup;
use App\Entity\Review;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Name',
                ],
                'row_attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('cover', TextType::class, [
                'attr' => [
                    'placeholder' => 'Cover',
                ],
                'row_attr' => [
                    'class' => 'form-control',
                ],
            ]) //FileType

            ->add('category', EntityType::class, [
                'class' => 'App\Entity\Category'
            ])
            ->add('tags', CollectionType::class)
            ->add('text', TextareaType::class, [
                'attr' => [
                    'rows' => '15'
                ],
            ])
            ->add('images', TextType::class) //FileType
            ->add('authorGrade', NumberType::class, [
                'row_attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
