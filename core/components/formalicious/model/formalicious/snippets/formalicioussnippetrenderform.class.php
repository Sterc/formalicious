<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

require_once dirname(__DIR__) . '/formalicioussnippets.class.php';

class FormaliciousSnippetRenderForm extends FormaliciousSnippets
{
    /**
     * @access public.
     * @var Array.
     */
    public $defaultProperties = [
        'hooks'                 => '',
        'preHooks'              => '',
        'postHooks'             => '',
        'renderHooks'           => 'FormaliciousHookRenderForm',

        'stepParam'             => 'step',
        'stepRedirect'          => '',
        'validate'              => '',
        'customValidators'      => '',
        'emailFrom'             => '',

        'tplForm'               => '@FILE elements/chunks/form.chunk.tpl',
        'tplStep'               => '@FILE elements/chunks/step.chunk.tpl',
        'tplNavigationItem'     => '@FILE elements/chunks/navigation/item.chunk.tpl',
        'tplNavigationWrapper'  => '@FILE elements/chunks/navigation/wrapper.chunk.tpl',
        'tplEmail'              => 'formaliciousEmailTpl',
        'tplEmailFieldsItem'    => '@FILE elements/chunks/email/item.chunk.tpl',
        'tplEmailFieldsWrapper' => '@FILE elements/chunks/email/wrapper.chunk.tpl',
        'tplFiarEmail'          => 'formaliciousFiarEmailTpl',

        'usePdoTools'           => false,
        'usePdoElementsPath'    => false
    ];

    /**
     * @access public.
     * @param Array $properties.
     * @return String.
     */
    public function run(array $properties = [])
    {
        $this->properties = array_merge($this->defaultProperties, $properties);

        $form = $this->modx->getObject('FormaliciousForm', [
            'id' => $this->getProperty('form')
        ]);

        if ($form) {
            if (!$form->isPublished()) {
                return false;
            }

            $fields         = [];
            $fieldsEmail    = [];
            $stepUrls       = [];
            $validation     = [];

            $parameters = [
                'name'                  => $form->get('name'),
                'formid'                => $form->get('id'),
                'submitVar'             => 'form_submit_' . $form->get('id'),
                'saveTmpFiles'          => 1,
                'customValidators'      => $this->getProperty('customValidators'),

                'formaliciousFormId'    => $form->get('id'),
                'formaliciousStep'      => 1,
            ];

            $placeholders = [
                'id'                    => $form->get('id'),
                'name'                  => $form->get('name'),
                'formid'                => $form->get('id'),
                'submitVar'             => 'form_submit_' . $form->get('id'),
                'submitTitle'           => ''
            ];

            $currentStep = $this->getCurrentStep();
            $totalSteps = $form->getStepsTotal();

            if ($totalSteps >= 1) {
                if ($currentStep >= $totalSteps) {
                    $currentStep = $totalSteps;
                }

                $currentStepIndex = 1;

                foreach ((array) $form->getSteps() as $step) {
                    $stepValidation = [];

                    foreach ((array) $step->getFields() as $field) {
                        $type = $field->getOne('Type');

                        if ($type) {
                            if ($currentStep === $currentStepIndex) {
                                $validation[$field->getName()] = $type->getValidation((bool) $field->get('required'));
                            }

                            $fields[$field->getName()] = $field->get('title');

                            if (!empty($this->getProperty('tplEmailFieldsItem'))) {
                                $fieldsEmail[] = $this->getChunk($this->getProperty('tplEmailFieldsItem'), [
                                    'label' => $field->get('title'),
                                    'value' => '[[!+fi.' . $field->getName() . ']]'
                                ]);
                            }
                        }
                    }

                    if ($currentStepIndex <= 1) {
                        $stepUrls[$currentStepIndex] = $this->getStepUrl();
                    } else {
                        $stepUrls[$currentStepIndex] = $this->getStepUrl([
                            $this->getProperty('stepParam') => $currentStepIndex
                        ]);
                    }

                    if ($currentStep === $currentStepIndex) {
                        $placeholders['submitTitle'] = $step->get('button');
                    }

                    $currentStepIndex++;
                }
                /*
                    Fix for prehooks: In the Formalicious manager component, hooks added to a form's Advanced Settings Prehooks
                    do not get added (only ones added via the FormaliciousRenderForm snippet call are). This change solves the
                    issue by merging the two hook sources
                */
                $formPrehooks = explode(',', trim($form->get('prehooks')));
                $formPrehooks = !empty($formPrehooks) ? array_map('trim', $formPrehooks) : $formPrehooks ;

                $scriptPrehooks = explode(',', trim($this->getProperty('preHooks')));
                $scriptPrehooks = !empty($scriptPrehooks) ? array_map('trim', $scriptPrehooks) : $scriptPrehooks ;

                $prehooks = array_filter(array_merge($formPrehooks, $scriptPrehooks));

                if ($form->get('posthooks')) {
                    $hooks = array_merge(
                        array_filter(explode(',', $this->getProperty('hooks'))),
                        array_filter(explode(',', trim($form->get('posthooks'))))
                    );
                } else {
                    $hooks = array_filter(explode(',', $this->getProperty('hooks')));
                }

                if (!in_array('spam', $hooks, true)) {
                    $hooks[] = 'spam';
                }

                if (!in_array('FormaliciousHookHandleForm', $hooks, true)) {
                    $hooks[] = 'FormaliciousHookHandleForm';
                }

                if ($currentStep >= $totalSteps && isset($_POST[$parameters['submitVar']])) {
                    if (!in_array('FormaliciousHookRemoveForm', $hooks, true)) {
                        $hooks[] = 'FormaliciousHookRemoveForm';
                    }

                    if ((int) $form->get('saveform') === 1) {
                        $hooks[] = 'FormItSaveForm';

                        $parameters['formName']         = $this->getOption('save_forms_prefix') . ': ' . $form->get('name');
                        $parameters['fieldNames']       = $this->parseFields($fields, 'names');
                        $parameters['formFields']       = $this->parseFields($fields, 'fields');
                    }

                    if ((int) $form->get('email') === 1) {
                        $hooks[] = 'email';

                        $parameters['emailFrom']        = $this->getProperty('emailFrom', $this->modx->getOption('emailsender'));
                        $parameters['emailTo']          = $form->get('emailto');
                        $parameters['emailSubject']     = $form->get('emailsubject');
                        $parameters['emailContent']     = $this->parseContent($form->get('emailcontent'));
                        $parameters['emailFields']      = $this->parseEmailFields($fieldsEmail);
                        $parameters['emailTpl']         = $this->getProperty('tplEmail');
                    }

                    if ((int) $form->get('fiaremail') === 1) {
                        $hooks[] = 'FormItAutoResponder';

                        $parameters['fiarFrom']         = $form->get('fiaremailfrom');
                        $parameters['fiarToField']      = 'field_' . $form->get('fiaremailto');
                        $parameters['fiarSubject']      = $form->get('fiaremailsubject');
                        $parameters['fiarContent']      = $this->parseContent($form->get('fiaremailcontent'));
                        $parameters['fiarFields']       = $this->parseEmailFields($fieldsEmail);
                        $parameters['fiarTpl']          = $this->getProperty('tplFiarEmail');

                        if ($form->get('fiaremailattachment')) {
                            $parameters['fiarFiles']    = rtrim($this->modx->getOption('modx_base_path', null, MODX_BASE_PATH), '/') . '/' . ltrim($form->get('fiaremailattachment'), '/');
                        }
                    }

                    if ((int) $form->get('redirectto') !== 0) {
                        $hooks[] = 'redirect';

                        $parameters['redirectTo'] = (int) $form->get('redirectto');
                    }

                    if (empty($placeholders['submitTitle'])) {
                        $placeholders['submitTitle'] = $this->modx->lexicon('formalicious.submit');
                    }
                } else {
                    $hooks[] = 'redirect';

                    /*
                        Set up redirect in a way that allows variable/dynamic destination, based on
                        value stored in the submit input/button. This way, form data on the step that is
                        being navigated away from will always be posted/saved. Navigation and pagination
                        should then be done via submit inputs/buttons instead of <a> tags.

                        A related change to FormIt's Request class is necessary for this additional functionality.
                    */

                    # Default redirect destination
                    $destination = $currentStep + 1;

                    # Check for alternate destination request
                    if ($_POST) {
                        foreach ($_POST as $k => $v) {
                            if (strpos($k, $parameters['submitVar']) !== false ) {
                                $destination = is_numeric($v) ? $v : $destination ;
                                break;
                            }
                        }
                    }

                    $parameters['redirectTo'] = $this->getStepUrl([
                        $this->getProperty('stepParam') => (int)$destination
                    ], 'full');

                    if (empty($placeholders['submitTitle'])) {
                        $placeholders['submitTitle'] = $this->modx->lexicon('formalicious.next');
                    }
                }

                $parameters['hooks'] = $this->parseHooks($hooks);
                $parameters['preHooks'] = $this->parseHooks($prehooks);
                $parameters['renderHooks'] = $this->parseHooks($this->getProperty('renderHooks'));
                $parameters['validate'] = $this->parseValidation($validation);

                foreach ((array) $form->getParameters() as $key => $value) {
                    $parameters[$key] = $value;
                }

                $placeholders['step'] = $currentStep;

                $parameters['formaliciousStep'] = $currentStep;
                $parameters['formaliciousSteps'] = $totalSteps;
                $parameters['formaliciousStepParam'] = $this->getProperty('stepParam');
                $parameters['formaliciousStepUrls'] = json_encode($stepUrls);
                $parameters['formaliciousTplStep'] = $this->getProperty('tplStep');
                $parameters['formaliciousTplNavigationItem'] = $this->getProperty('tplNavigationItem');
                $parameters['formaliciousTplNavigationWrapper'] = $this->getProperty('tplNavigationWrapper');

                if ($currentStep > 1) {
                    $placeholders['prevUrl'] = $this->getStepUrl([
                        $this->getProperty('stepParam') => $currentStep - 1
                    ]);
                    $placeholders['submitValPrev'] = $currentStep - 1;
                }

                $placeholders['submitValLast'] = $totalSteps;

                # Suggest renaming this placeholder, as it makes its purpose more immediately clear
                $placeholders['formAction'] = $totalSteps === 1
                    ? $this->getStepUrl()
                    : $this->getStepUrl([$this->getProperty('stepParam') => $currentStep])
                    ;

                # Set orignal for backward compatibility
                $placeholders['currentUrl'] = $placeholders['formAction'];

                return $this->getChunk($this->getProperty('tplForm'), array_merge($placeholders, $parameters, [
                    'FormItParameters' => $this->parseParameters($parameters)
                ]));
            }
        }

        return '';
    }

    /**
     * @access public.
     * @return Int.
     */
    public function getCurrentStep()
    {
        if (isset($_GET[$this->getProperty('stepParam')])) {
            return (int) $_GET[$this->getProperty('stepParam')];
        }

        return 1;
    }

    /**
     * @access public.
     * @param Array $fields.
     * @param String $type.
     * @return String.
     */
    public function parseFields(array $fields = [], $type)
    {
        if ($type === 'names') {
            return implode(',', array_map(function ($value, $key) {
                return $key . '==' . $value;
            }, $fields, array_keys($fields)));
        }

        return implode(',', array_keys($fields));
    }

    /**
     * @access public.
     * @param Array $validation.
     * @return String.
     */
    public function parseValidation(array $validation = [])
    {
        $validation = array_filter($validation);

        $validation = array_map(function ($value, $key) {
            return $key . ':' . implode(':', $value);
        }, $validation, array_keys($validation));

        if ($this->getProperty('validate')) {
            $validation[] = $this->getProperty('validate');
        }

        return implode(',', $validation);
    }

    /**
     * @access public.
     * @param Array|String $hooks.
     * @return String.
     */
    public function parseHooks($hooks = [])
    {
        if (is_string($hooks)) {
            return $hooks;
        }

        return implode(',', $hooks);
    }

    /**
     * @access public.
     * @param Array $parameters.
     * @return String.
     */
    public function parseParameters(array $parameters = [])
    {
        return implode(PHP_EOL, array_map(function ($value, $key) {
            return '&' . $key . '=`' . $value . '`';
        }, $parameters, array_keys($parameters)));
    }

    /**
     * @access public.
     * @param Array $emailFields.
     * @return String.
     */
    public function parseEmailFields(array $emailFields = [])
    {
        if (count($emailFields) >= 1) {
            if (!empty($this->getProperty('tplEmailFieldsWrapper'))) {
                return $this->getChunk($this->getProperty('tplEmailFieldsWrapper'), [
                    'output' => implode(PHP_EOL, $emailFields)
                ]);
            }

            return implode(PHP_EOL, $emailFields);
        }

        return '';
    }

    /**
     * @access public.
     * @param Array $parameters.
     * @param String $scheme.
     * @return String.
     */
    public function getStepUrl(array $parameters = [], $scheme = null)
    {
        $stepRedirect       = $this->getProperty('stepRedirect');
        $requestUrl         = '';
        $requestParam       = $this->modx->getOption('request_param_alias', null, 'q');
        $requestParams      = $_GET;
        $requestFragment    = '#form-' . $this->getProperty('form');

        if ($requestParams[$requestParam]) {
            $requestUrl = $requestParams[$requestParam];

            unset($requestParams[$requestParam]);
        }

        if ($requestParams[$this->getProperty('stepParam')]) {
            unset($requestParams[$this->getProperty('stepParam')]);
        }

        if (!empty($stepRedirect)) {
            if ($stepRedirect !== 'request') {
                $requestUrl     = $stepRedirect;
                $requestParams  = [];

                if (strpos($requestUrl, '?')) {
                    $request = parse_url($requestUrl);

                    if (isset($request['path'])) {
                        $requestUrl = $request['path'];
                    }

                    if (isset($request['query'])) {
                        parse_str($request['query'], $requestParams);
                    }
                }
            }

            $requestParams = array_merge($requestParams, $parameters);

            if ($scheme === 'full' && !strpos($requestUrl, 'http')) {
                $requestUrl = rtrim($this->modx->makeUrl($this->modx->getOption('site_start'), null, null, 'full'), '/') . '/' . ltrim($requestUrl, '/');
            }

            if (count($requestParams) >= 1) {
                return $requestUrl . '?' . http_build_query($requestParams) . $requestFragment;
            }

            return $requestUrl . '#form-' . $requestFragment;
        }

        return $this->modx->makeUrl($this->modx->resource->get('id'), null, array_merge($requestParams, $parameters), 'full') . $requestFragment;
    }
}
