<?php

namespace TM\PlatformBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre :'
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Description :'
            ))
            ->add('nbMate', IntegerType::class, array(
                'label' => 'Nombre de compagnons :'
            ))
            ->add('cost', ChoiceType::class, array(
                'label' => 'Coût estimé :',
                'choices'  => array(
                    'faible' => 1,
                    'accessible' => 2,
                    'modéré' => 3,
                    'coûteux' => 4,
                    'onéreux' => 5
                ),
                'expanded' => true
            ))
            ->add('startDate', DateType::class, array(
                'label' => 'Date de départ :',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'js-datepicker')
            ))
            ->add('categories', EntityType::class, array(
                'label' => 'Type(s) de voyage :',
                'class'         => 'TMPlatformBundle:Category',
                'choice_label'  => 'name',
                'multiple'      => true
            ))
            ->add('nbDuration', IntegerType::class, array(
                'label' => 'Durée estimée :'
            ))
            ->add('typeDuration', ChoiceType::class, array(
                'label' => 'Durée estimée :',
                'choices'  => array(
                    'jour(s)' => 'day',
                    'semaine(s)' => 'week',
                    'mois' => 'month',
                    'année(s)' => 'year'
                )
            ))
            ->add('countries', CountryType::class, array(
                'label' => 'Pays concerné(s) :',
                'multiple' => true
            ))
            ->add('Ajouter ce voyage', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TM\PlatformBundle\Entity\Travel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tm_platformbundle_travel';
    }
}
