<?php

namespace App\Form;

use App\Entity\Language;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LanguageSwitcherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // build a select dropdown containing all of the entities in that class
            ->add('language', EntityType::class,
                [ // option :
                    'class' => Language::class, // that class is Language class
                    'choice_label' => 'name', // property that should be used for displaying
                    'choice_value' => 'code' // give the langcode as a value
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        // 'data_class' => Language::class,
        ]);
    }
}
