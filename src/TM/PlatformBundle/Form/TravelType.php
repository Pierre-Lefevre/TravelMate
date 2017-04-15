<?php

namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TravelType
 * @package TM\PlatformBundle\Form
 */
class TravelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
            'label' => 'Titre'
        ))->add('content', TextareaType::class, array(
            'label' => 'Description'
        ))->add('nbMate', IntegerType::class, array(
            'label' => 'Nombre de compagnons',
            'attr' => array(
                'min' => '1',
                'value' => '1'
            )
        ))->add('cost', CostType::class)
        ->add('startDate', MyDateType::class, array(
            'label' => 'Date de départ'
        ))->add('categories', CategoryType::class, array(
            'multiple' => true
        ))->add('nbDuration', IntegerType::class, array(
            'label' => 'Durée estimée',
            'attr' => array(
                'min' => '1',
                'value' => '1'
            )
        ))->add('typeDuration', DurationType::class, array(
            'label' => 'Durée estimée',
        ))->add('countries', CountryType::class, array(
            'label'    => 'Pays',
            'multiple' => true
        ))->add('submit', SubmitType::class, array(
            'attr' => array(
                'class' => 'button success'
            )
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TM\PlatformBundle\Entity\Travel'
        ));
    }
}
