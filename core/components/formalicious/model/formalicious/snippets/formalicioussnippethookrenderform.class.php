<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

require_once dirname(__DIR__) . '/formalicioussnippets.class.php';

class FormaliciousSnippetHookRenderForm extends FormaliciousSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $defaultProperties = [
        'usePdoTools'           => false,
        'usePdoElementsPath'    => false
    ];

    /**
     * @access public.
     * @param Object $hook.
     * @param Array $errors.
     * @return Mixed.
     */
    public function run($hook, array $errors = [])
    {
        $this->properties = array_merge($this->properties, $hook->config);
        
        $formit =& $hook->formit;
        $values = $hook->getValues();

        $stepUrls = json_decode($formit->config['formaliciousStepUrls'], true);

        $form = $this->modx->getObject('FormaliciousForm', [
            'id' => $formit->config['formaliciousFormId']
        ]);

        if ($form) {
            $values = $this->getFormValues($hook);

            $formOutput = '';
            $formNavigationOutput = [];

            $currentStepIndex = 1;

            foreach ((array) $form->getSteps() as $step) {
                if ((int) $formit->config['formaliciousStep'] === $currentStepIndex) {
                    $stepOutput = [];

                    foreach ((array) $step->getFields() as $field) {
                        $type = $field->getOne('Type');

                        if ($type) {
                            $fieldOutput = [];
                            $fieldValue  = '';

                            if ($formit->request && !$formit->request->hasSubmission()) {
                                $fieldValue = $field->getDefaultValue();
                            }

                            if (isset($values[$field->getName()])) {
                                $fieldValue = $values[$field->getName()];
                            }

                            if ((int) $type->get('values') === 1) {
                                foreach ((array) $field->getAnswers() as $key => $answer) {
                                    $fieldOutput[] = $this->getChunk($type->get('answertpl'), array_merge($answer->toArray(), [
                                        'uniqid'    => uniqid(),
                                        'title'     => $answer->get('name'),
                                        'name'      => $field->getName(),
                                        'value'     => is_array($fieldValue) ? json_encode($fieldValue) : $fieldValue,
                                        'idx'       => $key
                                    ]));
                                }
                            }
                        }

                        $stepOutput[] = $this->getChunk($type->get('tpl'), array_merge($field->toArray(), [
                            'uniqid'        => uniqid(),
                            'name'          => $field->getName(),
                            'description'   => $field->getDescription(),
                            'value'         => $fieldValue,
                            'values'        => implode(PHP_EOL, $fieldOutput),
                            'valuesCount'   => count($fieldOutput),
                            'error'         => isset($errors[$field->getName()]) ? $errors[$field->getName()] : ''
                        ]));
                    }

                    if (!empty($formit->config['formaliciousTplStep'])) {
                        $formOutput = $this->getChunk($formit->config['formaliciousTplStep'], array_merge($step->toArray(), [
                            'fields' => implode(PHP_EOL, $stepOutput)
                        ]));
                    } else {
                        $formOutput = implode(PHP_EOL, $stepOutput);
                    }
                }

                if (!empty($formit->config['formaliciousTplNavigationItem'])) {
                    $state  = '';

                    if ((int) $formit->config['formaliciousStep'] === $currentStepIndex) {
                        $state = 'active';
                    } else if ((int) $formit->config['formaliciousStep'] > $currentStepIndex) {
                        $state = 'valid';
                    }

                    $formNavigationOutput[] = $this->getChunk($formit->config['formaliciousTplNavigationItem'], array_merge($step->toArray(), [
                        'state' => $state,
                        'url'   => $stepUrls[$currentStepIndex],
                        'idx'   => $currentStepIndex
                    ]));
                }

                $currentStepIndex++;
            }

            $this->modx->toPlaceholders([
                'form'          => $formOutput,
                'navigation'    => $this->parseNavigation($formit, $formNavigationOutput)
            ], 'formalicious');
        }

        return true;
    }

    /**
     * @access public.
     * @param Object $formit.
     * @param Array $steps.
     * @return String.
     */
    public function parseNavigation($formit, array $steps = [])
    {
        if (count($steps) > 1) {
            if (!empty($formit->config['formaliciousTplNavigationItem'])) {
                return $this->getChunk($formit->config['formaliciousTplNavigationWrapper'], [
                    'output' => implode(PHP_EOL, $steps)
                ]);
            }

            return implode(PHP_EOL, $steps);
        }

        return '';
    }
}
