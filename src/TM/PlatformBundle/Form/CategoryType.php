<?php
namespace TM\PlatformBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CategoryType
 * @package TM\PlatformBundle\Form
 */
class CategoryType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'        => 'Type(s) de voyage',
            'class'        => 'TMPlatformBundle:Category',
            'choice_label' => 'name',
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return EntityType::class;
    }
}
