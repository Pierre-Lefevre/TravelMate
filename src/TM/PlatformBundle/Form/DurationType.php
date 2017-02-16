<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DurationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => array(
                'Jour(s)'    => 'day',
                'Semaine(s)' => 'week',
                'Mois'       => 'month',
                'Année(s)'   => 'year'
            )
        ));
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
