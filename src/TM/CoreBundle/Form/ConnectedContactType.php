<?php

namespace TM\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ContactType
 */
class ConnectedContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('subject', TextType::class, array(
            'label'       => 'Sujet',
            'constraints' => array(
                new NotBlank(),
            )
        ))->add('message', TextareaType::class, array(
            'label'       => 'Message',
            'constraints' => array(
                new NotBlank(),
            )
        ));
    }
}
