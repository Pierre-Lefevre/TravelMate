<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CostType
 * @package TM\PlatformBundle\Form
 */
class CostType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'   => 'Coût',
            'choices' => array(
                'Faible'     => 1,
                'Accessible' => 2,
                'Modéré'     => 3,
                'Coûteux'    => 4,
                'Onéreux'    => 5
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
