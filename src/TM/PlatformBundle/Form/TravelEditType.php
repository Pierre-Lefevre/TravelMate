<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class TravelEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $field = $builder->get('nbMate');
        $options = $field->getOptions();
        unset($options['attr']['value']);
        $builder->add('nbMate', IntegerType::class, $options);

        $field = $builder->get('nbDuration');
        $options = $field->getOptions();
        unset($options['attr']['value']);
        $builder->add('nbDuration', IntegerType::class, $options);
    }

    public function getParent()
    {
        return TravelType::class;
    }
}
