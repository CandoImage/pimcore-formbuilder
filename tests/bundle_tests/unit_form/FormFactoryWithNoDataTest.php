<?php

namespace DachcomBundle\Test\Unit;

use DachcomBundle\Test\Test\DachcomBundleTestCase;
use FormBuilderBundle\Factory\FormFactoryInterface;
use FormBuilderBundle\Storage\Form;
use FormBuilderBundle\Storage\FormField;

class FormFactoryWithNoDataTest extends DachcomBundleTestCase
{
    public function testFormCreation()
    {
        $factory = $this->getContainer()->get(FormFactoryInterface::class);

        $form = $factory->createForm();
        $this->assertInstanceOf(Form::class, $form);
    }

    public function testFormGetterById()
    {
        $factory = $this->getContainer()->get(FormFactoryInterface::class);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Form with id: 99 doesn\'t exist');

        $factory->getFormById(99);
    }

    public function testFormGetterIdByName()
    {
        $factory = $this->getContainer()->get(FormFactoryInterface::class);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Form with ID form doesn\'t exist');

        $factory->getFormIdByName('form');
    }

    public function testFormGetAll()
    {
        $factory = $this->getContainer()->get(FormFactoryInterface::class);

        $forms = $factory->getAllForms();
        $this->assertCount(0, $forms);
    }

    public function testFormFieldCreation()
    {
        $factory = $this->getContainer()->get(FormFactoryInterface::class);

        $form = $factory->createFormField();
        $this->assertInstanceOf(FormField::class, $form);
    }

}
