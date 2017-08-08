<?php

namespace FormBuilderBundle\Form\Type;

use FormBuilderBundle\Mapper\FormTypeOptionsMapper;
use FormBuilderBundle\Storage\FormField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;

class TextType extends AbstractType
{
    use SimpleTypeTrait;

    /**
     * @var string
     */
    protected $type = 'text_type';

    /**
     * @var string
     */
    protected $title = 'Text Type';

    /**
     * @var string
     */
    protected $template = 'FormBuilderBundle:forms:fields/types/text.html.twig';

    /**
     * @param FormBuilderInterface $builder
     * @param FormField            $field
     */
    public function build(FormBuilderInterface $builder, FormField $field)
    {
        $options = $this->parseOptions($field->getOptions());
        $options['attr']['width'] = $field->getWidth();

        $builder->add($field->getName(), TypeTextType::class, $options);
    }

    /**
     * @param FormTypeOptionsMapper $typeOptions
     *
     * @return array
     */
    public function parseOptions(FormTypeOptionsMapper $typeOptions)
    {
        $options = [
            'attr' => [],
            'constraints' => []
        ];

        // required
        //if ($field->getRequired()) {
        //    $options['constraints'][] = new NotBlank();
        //}

        $options['label'] = $typeOptions->hasLabel(true) ? $typeOptions->getLabel() : FALSE;
        $options['required'] = $typeOptions->hasRequired() ? $typeOptions->isRequired() : FALSE;
        $options['attr']['placeholder'] = $typeOptions->hasPlaceholder() ? $typeOptions->getPlaceholder() : '';

        return $options;

    }
}