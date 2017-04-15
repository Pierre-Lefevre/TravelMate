<?php

namespace TM\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ContactType
 */
class NotConnectedContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label'       => 'Nom',
            'constraints' => array(
                new NotBlank(),
            )
        ))->add('email', EmailType::class, array(
            'label'       => 'Adresse e-mail',
            'constraints' => array(
                new NotBlank(),
                new Email(),
            )
        ));
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return ConnectedContactType::class;
    }
}
