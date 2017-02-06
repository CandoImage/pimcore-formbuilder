<?php

namespace Pimcore\Model\Document\Tag\Area;

use Pimcore\Model\Document;

use Formbuilder\Lib\Processor;
use Formbuilder\Lib\Form\Frontend\Builder;
use Formbuilder\Tool\Preset;
use Formbuilder\Model\Configuration;
use Formbuilder\Model\Form as FormModel;

class Form extends Document\Tag\Area\AbstractArea
{
    /**
     *
     */
    public function action()
    {
        if ($this->view->editmode) {
            $mainList = new FormModel();

            $mains = $mainList->getAll();
            $formPresets = Preset::getAvailablePresets();

            $formPresetsStore = [];
            $formPresetsInfo = [];
            $availableForms = [];

            if (!empty($mains)) {
                foreach ($mains as $form) {
                    $availableForms[] = [$form['id'], $form['name']];
                }
            }

            $availableFormsTypes = [
                ['horizontal', 'Horizontal'],
                ['vertical', 'Vertical']
            ];

            $this->view->assign(
                [
                    'availableForms'     => $availableForms,
                    'availableFormTypes' => $availableFormsTypes,
                ]
            );

            if (!empty($formPresets)) {
                $formPresetsStore[] = ['custom', $this->view->translateAdmin('no form preset')];

                foreach ($formPresets as $presetName => $preset) {
                    $formPresetsStore[] = [$presetName, $preset['niceName']];
                    $formPresetsInfo[] = Preset::getDataForPreview($presetName, $preset);
                }

                if ($this->view->select('formPreset')->isEmpty()) {
                    $this->view->select('formPreset')->setDataFromResource('custom');
                }

                $this->view->assign(
                    [
                        'availableFormPresets' => $formPresetsStore,
                        'formPresetsInfo'      => $formPresetsInfo,
                    ]
                );
            }
        }

        $formData = NULL;
        $formId = NULL;
        $formHtml = NULL;
        $messageHtml = NULL;
        $messages = [];

        $noteMessage = '';
        $noteError = FALSE;

        $horizontalForm = TRUE;
        $inlineForm = FALSE;

        $sendCopy = $this->view->checkbox('userCopy')->isChecked() === '1';
        $formPreset = $this->view->select('formPreset')->getData();

        if (empty($formPreset) || is_null($formPreset)) {
            $formPreset = 'custom';
        }

        if (!$this->view->select('formName')->isEmpty()) {
            $formId = $this->view->select('formName')->getData();
        }

        if ($this->view->select('formType')->getData() == 'vertical') {
            $horizontalForm = FALSE;
        }

        $copyMailTemplate = NULL;

        if (!empty($formId)) {
            try {
                $formData = FormModel::getById($formId);

                if (!$formData instanceof FormModel) {
                    $noteMessage = 'Form (' . $formId . ') is not a valid FormBuilder Element.';
                    $noteError = TRUE;
                }
            } catch (\Exception $e) {
                $noteMessage = $e->getMessage();
                $noteError = TRUE;
            }
        } else {
            $noteMessage = 'No valid form selected.';
            $noteError = TRUE;
        }

        if ($noteError === TRUE) {
            $this->view->assign(
                [
                    'form'          => NULL,
                    'messages'      => NULL,
                    'formId'        => NULL,
                    'formPreset'    => NULL,
                    'notifications' => ['error' => $noteError, 'message' => $noteMessage],
                ]
            );

            return FALSE;
        }

        $frontendLib = new Builder();

        $twitterFormType = $horizontalForm ? 'TwitterHorizontal' : ($inlineForm ? 'TwitterInline' : 'TwitterVertical');
        $form = $frontendLib->getForm($formData->getId(), $this->view->language, $twitterFormType);

        $_mailTemplate = NULL;
        $_copyMailTemplate = NULL;

        $_mailTemplate = $this->view->href('sendMailTemplate')->getElement();
        $_copyMailTemplate = $this->view->href('sendCopyMailTemplate')->getElement();

        $mailTemplateId = NULL;
        $copyMailTemplateId = NULL;

        if ($_mailTemplate instanceof Document\Email) {
            $mailTemplateId = $_mailTemplate->getId();
        }

        if ($sendCopy === TRUE && $_copyMailTemplate instanceof Document\Email) {
            $copyMailTemplateId = $_copyMailTemplate->getId();
        } else //disable copy!
        {
            $sendCopy = FALSE;
        }

        if ($form !== FALSE) {
            $frontendLib->addDefaultValuesToForm(
                $form,
                [
                    'formData'           => $formData,
                    'formPreset'         => $formPreset,
                    'formId'             => $formId,
                    'locale'             => $this->view->language,
                    'mailTemplateId'     => $mailTemplateId,
                    'copyMailTemplateId' => $copyMailTemplateId,
                    'sendCopy'           => $sendCopy
                ]
            );

            if (\Zend_Controller_Front::getInstance()->getRequest()->isPost()) {
                $valid = $form->isValid($frontendLib->parseFormParams($this->getAllParams(), $form));

                if ($valid) {
                    $processor = new Processor();
                    $processor->setSendCopy($sendCopy);

                    $processor->parse($form, $formData, $mailTemplateId, $copyMailTemplateId);

                    $valid = $processor->isValid();
                    $messages = $processor->getMessages();

                    if ($valid === TRUE) {
                        $messages = [$this->view->translate('form has been successfully sent')];
                    }

                    if (!empty($messages)) {
                        $messageHtml = $this->view->partial('formbuilder/form/partials/notifications.php', ['valid' => $valid, 'messages' => $messages]);
                    }

                    $form->reset();
                }
            }

            $formHtml = $form->render($this->view);
        }

        $this->view->assign(
            [
                'form'          => $formHtml,
                'messages'      => $messageHtml,
                'formId'        => $formId,
                'formPreset'    => $formPreset,
                'notifications' => [],
            ]
        );
    }

}