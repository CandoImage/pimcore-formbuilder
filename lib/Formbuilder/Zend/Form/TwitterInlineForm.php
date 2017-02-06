<?php

namespace Formbuilder\Zend\Form;

use Formbuilder\Zend\Traits\Form;

class TwitterInlineForm extends \Twitter_Bootstrap3_Form_Inline
{
    use Form;

    /**
     * @var bool
     */
    public $isBootstrapForm = TRUE;

    public function __construct($formData)
    {
        $this->addPrefixes();
        parent::__construct($formData);
    }

    /**
     * Retrieve a registered decorator for type element
     *
     * @param  string $type
     *
     * @return array
     */
    public function getDefaultDecoratorsByElementType($type)
    {
        if ($this->isValidFormBuilderElement($type)) {
            return parent::getDefaultDecoratorsByElementType('text');
        }

        return parent::getDefaultDecoratorsByElementType($type);
    }

}