<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DurationType
 * @package TM\PlatformBundle\Form
 */
class DurationType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
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

    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
