<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyDateType extends AbstractType
{
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

    public function getParent()
    {
        return DateType::class;
    }
}
