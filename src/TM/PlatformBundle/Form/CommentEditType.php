<?php
namespace TM\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CommentEditType
 * @package TM\PlatformBundle\Form
 */
class CommentEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $field = $builder->get('submit');
        $options = $field->getOptions();
        $type = $field->getType()->getTypeExtensions()[0]->getExtendedType();
        $options['label'] = "Modifier";
        $builder->add('submit', $type, $options);
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return CommentType::class;
    }
}
