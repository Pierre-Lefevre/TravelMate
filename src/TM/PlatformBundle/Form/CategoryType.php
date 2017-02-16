<?php
namespace TM\PlatformBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'        => 'Type(s) de voyage :',
            'class'        => 'TMPlatformBundle:Category',
            'choice_label' => 'name',
        ));
    }

    public function getParent()
    {
        return EntityType::class;
    }
}
