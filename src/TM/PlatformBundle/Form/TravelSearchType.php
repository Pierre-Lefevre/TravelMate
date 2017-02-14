<?php
namespace TM\PlatformBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class TravelSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('countries', CountryType::class, array(
                'label' => 'Pays : ',
                'placeholder' => 'Pays',
                'required' => false
            ))
            ->add('begin', DateType::class, array(
                'label' => 'Départ entre le ',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'js-datepicker','placeholder' => 'dd/mm/yyyy'),
                'required' => false
            ))
            ->add('end', DateType::class, array(
                'label' => ' et le ',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => array('class' => 'js-datepicker','placeholder' => 'dd/mm/yyyy'),
                'required' => false
            ))
            ->add('nbDuration', IntegerType::class, array(
                'label' => 'Durée : ',
                'required' => false,

                'attr' => array('placeholder'=>"Durée")
            ))
            ->add('typeDuration', ChoiceType::class, array(
                'label' => 'Durée : ',
                'choices'  => array(
                    'estimée' => '',
                    'jour(s)' => 'day',
                    'semaine(s)' => 'week',
                    'mois' => 'month',
                    'année(s)' => 'year'
                ),
                'required' => false,

            ))
            ->add('categories', EntityType::class, array(
                'label' => 'Type de voyage : ',
                'class'         => 'TMPlatformBundle:Category',
                'choice_label'  => 'name',
                'placeholder' => "Type de voyage",
                'required' => false
            ))
            ->add('cost', ChoiceType::class, array(
                'label' => 'Coût estimé : ',
                'choices'  => array(
                    'Coût' => '',
                    'faible' => 1,
                    'accessible' => 2,
                    'modéré' => 3,
                    'coûteux' => 4,
                    'onéreux' => 5
                ),
                'required' => false
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Rechercher'
            ));
    }


}
