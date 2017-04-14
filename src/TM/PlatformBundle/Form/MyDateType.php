<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MyDateType
 * @package TM\PlatformBundle\Form
 */
class MyDateType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'widget' => 'single_text',
            'html5'  => false,
            'format' => 'dd/MM/yyyy',
            'attr'   => array(
                'class'       => 'datepicker',
                'placeholder' => 'dd/mm/yyyy'
            )
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return DateType::class;
    }
}
