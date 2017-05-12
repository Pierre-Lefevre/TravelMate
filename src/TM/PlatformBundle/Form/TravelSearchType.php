<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TravelSearchType
 * @package TM\PlatformBundle\Form
 */
class TravelSearchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setMethod('GET')
        ->add('countries', CountryType::class, array(
            'placeholder' => 'Pays',
            'label'    => 'Pays',
            'required' => false,
            'data' => $options["code"]
        ))->add('begin', MyDateType::class, array(
            'label'    => 'Départ entre le',
            'required' => false
        ))->add('end', MyDateType::class, array(
            'label'    => 'et le',
            'required' => false
        ))->add('nbDuration', IntegerType::class, array(
            'label'    => 'Durée',
            'attr'     => array(
                'placeholder' => 'Durée'
            ),
            'required' => false,
        ))->add('typeDuration', DurationType::class, array(
            'label'       => 'Durée',
            'placeholder' => 'estimée',
            'required'    => false,
        ))->add('categories', CategoryType::class, array(
            'placeholder' => 'Type de voyage',
            'required'    => false
        ))->add('cost', CostType::class, array(
            'placeholder' => 'Coût',
            'required'    => false
        ))->add('submit', SubmitType::class, array(
            'label' => 'Rechercher',
            'attr' => array(
                'class' => 'button'
            )
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'code' => null,
        ));
    }
}
