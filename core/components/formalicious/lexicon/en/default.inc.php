<?php

/**
 * Formalicious
 *
 * Copyright 2019 by Sterc <modx@sterc.nl>
 */

$_lang['formalicious']                                          = 'Formalicious';
$_lang['formalicious.desc']                                     = 'The most powerful and easiest form builder for MODX.';

$_lang['area_formalicious']                                     = 'Formalicious';
$_lang['area_formalicious_editor']                              = 'Formalicious (rich text editor)';

$_lang['setting_formalicious.branding_url']                     = 'Branding';
$_lang['setting_formalicious.branding_url_desc']                = 'The URL of the branding button, if the URL is empty the branding button won\'t be shown.';
$_lang['setting_formalicious.branding_url_help']                = 'Branding (help)';
$_lang['setting_formalicious.branding_url_help_desc']           = 'The URL of the branding help button, if the URL is empty the branding help button won\'t be shown.';
$_lang['setting_formalicious.saveforms']                        = 'Save Forms';
$_lang['setting_formalicious.saveforms_desc']                   = 'Users are allowed to save forms in FormIt.';
$_lang['setting_formalicious.saveforms_prefix']                 = 'Save Forms Prefix';
$_lang['setting_formalicious.saveforms_prefix_desc']            = 'When users are allowd to save Forms in FormIt the name will be prefixed with this prefix.';
$_lang['setting_formalicious.disallowed_hooks']                 = 'Not Allowed Hooks';
$_lang['setting_formalicious.disallowed_hooks_desc']            = 'The not allowed FormIt snippet call hooks. Separate multiple hooks with a comma, default is "spam,email,redirect".';
$_lang['setting_formalicious.preview_css']                      = 'Form Preview CSS';
$_lang['setting_formalicious.preview_css_desc']                 = 'The URL of the CSS file thay will be loaded for the preview of a form.';
$_lang['setting_formalicious.use_editor']                       = 'Use rich text editor';
$_lang['setting_formalicious.use_editor_desc']                  = 'Use a rich text editor for the chatbot.';
$_lang['setting_formalicious.editor_plugins']                   = 'Plugins';
$_lang['setting_formalicious.editor_plugins_desc']              = 'The \'plugins\' config for the rich text editor.';
$_lang['setting_formalicious.editor_toolbar1']                  = 'Toolbar 1';
$_lang['setting_formalicious.editor_toolbar1_desc']             = 'The \'toolbar1\' config for the rich text editor.';
$_lang['setting_formalicious.editor_toolbar2']                  = 'Toolbar 2';
$_lang['setting_formalicious.editor_toolbar2_desc']             = 'The \'toolbar2\' config for the rich text editor.';
$_lang['setting_formalicious.editor_toolbar3']                  = 'Toolbar 3';
$_lang['setting_formalicious.editor_toolbar3_desc']             = 'The \'toolbar3\' config for the rich text editor.';
$_lang['setting_formalicious.editor_menubar']                   = 'Menubar';
$_lang['setting_formalicious.editor_menubar_desc']              = 'The \'menubar\' config for the rich text editor.';
$_lang['setting_formalicious.editor_statusbar']                 = 'Statusbar';
$_lang['setting_formalicious.editor_statusbar_desc']            = 'The \'statusbar\' config for the rich text editor.';

$_lang['formalicious.category']                                 = 'Category';
$_lang['formalicious.categories']                               = 'Categories';
$_lang['formalicious.categories.desc']                          = 'Organising your forms from the start is highly recommended. You can do this by creating categories below. These categories appear as tabs in your forms-overivew.';
$_lang['formalicious.categories.create']                        = 'Create Category';
$_lang['formalicious.categories.update']                        = 'Update Category';
$_lang['formalicious.categories.remove']                        = 'Remove Category';
$_lang['formalicious.categories.remove_confirm']                = 'Are you sure you want to remove this category?';

$_lang['formalicious.categories.label_name']                    = 'Name';
$_lang['formalicious.categories.label_name_desc']               = '';
$_lang['formalicious.categories.label_description']             = 'Description';
$_lang['formalicious.categories.label_description_desc']        = '';
$_lang['formalicious.categories.label_published']               = 'Published';
$_lang['formalicious.categories.label_published_desc']          = '';

$_lang['formalicious.fieldtype']                                = 'Field Type';
$_lang['formalicious.fieldtypes']                               = 'Field Types';
$_lang['formalicious.fieldtypes.desc']                          = 'A form consists of fields. These fields can be categorised by type, e.g. text or email. Formalicious is shipped with all the fields required to build powerful forms, but you can create your own types below.';
$_lang['formalicious.fieldtypes.create']                        = 'Create Field Type';
$_lang['formalicious.fieldtypes.update']                        = 'Update Field Type';
$_lang['formalicious.fieldtypes.remove']                        = 'Remove Field Type';
$_lang['formalicious.fieldtypes.remove_confirm']                = 'Are you sure you want to remove this field type? This also removes all the fields that are connected to this field type.';
$_lang['formalicious.fieldtypes.duplicate']                     = 'Duplicate Field Type';

$_lang['formalicious.fieldtypes.label_name']                    = 'Name';
$_lang['formalicious.fieldtypes.label_name_desc']               = '';
$_lang['formalicious.fieldtypes.label_tpl']                     = 'Chunk';
$_lang['formalicious.fieldtypes.label_tpl_desc']                = 'The name of the chunk that is used as template for this field type.';
$_lang['formalicious.fieldtypes.label_fields']                  = 'Fields';
$_lang['formalicious.fieldtypes.label_fields_desc']             = '';
$_lang['formalicious.fieldtypes.label_values']                  = 'Values';
$_lang['formalicious.fieldtypes.label_values_desc']             = 'This field type can contain field values.';
$_lang['formalicious.fieldtypes.label_answertpl']               = 'Values Chunk';
$_lang['formalicious.fieldtypes.label_answertpl_desc']          = 'The name of the chunk that is used as template for the field values. Field values are required for selectboxes, checkboxes and radio buttons.';
$_lang['formalicious.fieldtypes.label_validation']              = 'Validators';
$_lang['formalicious.fieldtypes.label_validation_desc']         = 'Comma separated list of FormIt validators to use for this field. See the built-in validators section on https://docs.modx.com/extras/revo/formit/formit.validators.';
$_lang['formalicious.fieldtypes.label_icon']                    = 'Icon';
$_lang['formalicious.fieldtypes.label_icon_desc']               = 'When adding a field to the form, this icon is shown when choosing a field type.';

$_lang['formalicious.form']                                     = 'Form';
$_lang['formalicious.forms']                                    = 'Forms';
$_lang['formalicious.forms.create']                             = 'Create Form';
$_lang['formalicious.forms.update']                             = 'Update Form';
$_lang['formalicious.forms.remove']                             = 'Remove Form';
$_lang['formalicious.forms.remove_confirm']                     = 'Are you sure you want to remove this form? This also removes all the child steps and fields.';
$_lang['formalicious.forms.duplicate']                          = 'Duplicate form';

$_lang['formalicious.settings']                                 = 'Settings';
$_lang['formalicious.settings.desc']                            = 'Here you can manage the form settings. Here you can set up a \'thank you page\' where the visitor will send to after he fills in the form.';

$_lang['formalicious.settings.email.desc']                      = 'Here you can manage the email that will be sent when a visitor completes the form, to send an email you need to set up the following settings.';
$_lang['formalicious.settings.fair.desc']                       = 'Here you can manage the auto-reply email that will be sent to the visitor when he completes the form, to send an auto-reply email you need to set up the following settings.';

$_lang['formalicious.settings.label_name']                      = 'Name';
$_lang['formalicious.settings.label_name_desc']                 = 'The name of the form, this name is only visible within the MODx manager.';
$_lang['formalicious.settings.label_email']                     = 'Email';
$_lang['formalicious.settings.label_email_desc']                = 'When filled an email will be sent after the visitor completes the form.';
$_lang['formalicious.settings.label_emailto']                   = 'Email Receiver';
$_lang['formalicious.settings.label_emailto_desc']              = 'When filled the form will be sent to this emailaddress. For multiple addresses, enter those comma separately, for example: info@domain.com,admin@domain.com.';
$_lang['formalicious.settings.label_emailsubject']              = 'Email Subject';
$_lang['formalicious.settings.label_emailsubject_desc']         = 'This is the subject of the e-mail that will be sent when a visitor completes the form. For example: A contact form has been filled in.';
$_lang['formalicious.settings.label_emailcontent']              = 'Email Introtext';
$_lang['formalicious.settings.label_emailcontent_desc']         = 'This is the introtext of the e-mail that will be sent when a visitor completes the form. For example A contact form has been filled in within the website. An answer must be sent within 2 - 3 days.';
$_lang['formalicious.settings.label_redirectto']                = 'Redirect to';
$_lang['formalicious.settings.label_redirectto_desc']           = 'When filled the visitor will be redirected to this resource when he fills in a form. You can create this page within the tree structure on the left side. Always make sure that the resource can not be found within Google and the website by disabling this in the SEO tab of the resource.';
$_lang['formalicious.settings.label_saveform']                  = 'Save Submitted Forms';
$_lang['formalicious.settings.label_saveform_desc']             = 'When filled all the completed forms to be saved? The forms are then stored within FormIt tha can be found under the \'components\' menu.';
$_lang['formalicious.settings.label_published']                 = 'Published';
$_lang['formalicious.settings.label_published_desc']            = 'When filled the form will be available.';
$_lang['formalicious.settings.label_published_from']            = 'Publication Date';
$_lang['formalicious.settings.label_published_from_desc']       = 'When a publication date is filled the form will be available when this date is reached.';
$_lang['formalicious.settings.label_published_till']            = 'Un-publication Date';
$_lang['formalicious.settings.label_published_till_desc']       = 'When an un-publication date is filled the form publication will be undone when this date is reached.';
$_lang['formalicious.settings.label_fiaremail']                 = 'Auto-reply email';
$_lang['formalicious.settings.label_fiaremail_desc']            = 'When filled an auto reply email will be sent to the visitor after he completes the form.';
$_lang['formalicious.settings.label_fiaremailto']               = 'Auto-reply Email Field';
$_lang['formalicious.settings.label_fiaremailto_desc']          = 'Select the email field where the auto-reply email should be sent. If no fields are available, first add fields to the form via the tab \'Form fields\'.';
$_lang['formalicious.settings.label_fiaremailfrom']             = 'Auto-reply Email From';
$_lang['formalicious.settings.label_fiaremailfrom_desc']        = 'Enter the email address of the auto-reply email. For example, info@companyname.com. The visitor sees this as the sender in his/her mailbox.';
$_lang['formalicious.settings.label_fiaremailsubject']          = 'Auto-reply Email Subject';
$_lang['formalicious.settings.label_fiaremailsubject_desc']     = 'This is the subject of the auto-reply email. This is the subject the visitor sees when they receive this e-mail in his/her mailbox.';
$_lang['formalicious.settings.label_fiaremailcontent']          = 'Auto-reply Email Introtext';
$_lang['formalicious.settings.label_fiaremailcontent_desc']     = 'This is the introtext of the auto-reply email. For example: Hello! Thank you for filling in our contact form. Within 2 - 3 days you can expect a response from us. With kind regards, company name X.';
$_lang['formalicious.settings.label_fiaremailattachment']       = 'Auto-reply Email Attachment';
$_lang['formalicious.settings.label_fiaremailattachment_desc']  = 'Select a file that will be sent as an attachment for the auto-reply email. This file is limited to the following file types: pdf, doc, docx, png, jpg, gif. The file must have a maximum file size of 8 MB.';

$_lang['formalicious.step']                                     = 'Field';
$_lang['formalicious.steps']                                    = 'Fields';
$_lang['formalicious.steps.desc']                               = 'Manage the form fields. A step can be renamed by double-clicking the text. You can rearrange the steps by dragging the tabs into the desired order.';
$_lang['formalicious.step.create']                              = 'Create Step';
$_lang['formalicious.step.update']                              = 'Update Step';
$_lang['formalicious.step.remove']                              = 'Remove Step';
$_lang['formalicious.step.remove_confirm']                      = 'Are you sure you want to remove this step? This also removes all the child fields.';
$_lang['formalicious.step.preview']                             = 'Step Preview';

$_lang['formalicious.step.label_title']                         = 'Title';
$_lang['formalicious.step.label_title_desc']                    = 'The title of the step.';
$_lang['formalicious.step.label_button']                        = 'Button Title';
$_lang['formalicious.step.label_button_desc']                   = 'The title of the submit or next button, when empty then will be "Submit" or "Next"  used by default.';

$_lang['formalicious.field.create']                             = 'Add Field';
$_lang['formalicious.field.update']                             = 'Update Field';
$_lang['formalicious.field.remove']                             = 'Remove Field';
$_lang['formalicious.field.remove_confirm']                     = 'Are you sure you want to remove this field?';
$_lang['formalicious.field.duplicate']                          = 'Duplicate Field';

$_lang['formalicious.field.label_type']                         = 'Type';
$_lang['formalicious.field.label_type_desc']                    = '';
$_lang['formalicious.field.label_title']                        = 'Title';
$_lang['formalicious.field.label_title_desc']                   = '';
$_lang['formalicious.field.label_description']                  = 'Description';
$_lang['formalicious.field.label_description_desc']             = 'The accompanying description that is shown below or above the field.';
$_lang['formalicious.field.label_placeholder']                  = 'Placeholder';
$_lang['formalicious.field.label_placeholder_desc']             = 'The temporary text in the field, which explains what a user has to fill in. Example placeholder: Please fill in your name.';
$_lang['formalicious.field.label_property']                     = 'Heading size';
$_lang['formalicious.field.label_property_desc']                = 'The font size of the heading.';
$_lang['formalicious.field.label_published']                    = 'Published';
$_lang['formalicious.field.label_published_desc']               = '';
$_lang['formalicious.field.label_required']                     = 'Required';
$_lang['formalicious.field.label_required_desc']                = '';

$_lang['formalicious.field.value']                              = 'Value';
$_lang['formalicious.field.values']                             = 'Values';
$_lang['formalicious.field.value.create']                       = 'Create Value';
$_lang['formalicious.field.value.update']                       = 'Update Value';
$_lang['formalicious.field.value.remove']                       = 'Remove Value';
$_lang['formalicious.field.value.remove_confirm']               = 'Are you sure you want to remove this value?';

$_lang['formalicious.field.value.label_name']                   = 'Name';
$_lang['formalicious.field.value.label_name_desc']              = '';
$_lang['formalicious.field.value.label_published']              = 'Published';
$_lang['formalicious.field.value.label_published_desc']         = '';
$_lang['formalicious.field.value.label_selected']               = 'Selected';
$_lang['formalicious.field.value.label_selected_desc']          = '';

$_lang['formalicious.advanced']                                 = 'Advanced Settings';
$_lang['formalicious.advanced.desc']                            = 'Advanced form settings.';

$_lang['formalicious.advanced.label_prehooks']                  = 'Prehooks';
$_lang['formalicious.advanced.label_prehooks_desc']             = 'Comma separated list of FormIt prehooks that will be executed when the form loads.';
$_lang['formalicious.advanced.label_posthooks']                 = 'Posthooks';
$_lang['formalicious.advanced.label_posthooks_desc']            = 'Comma separated list of FormIt posthooks that will be executed when the form is submitted. The hooks fire after successful validation.';

$_lang['formalicious.advanced.parameters']                      = 'Parameters';
$_lang['formalicious.advanced.parameters.desc']                 = 'Here you can add FormIt parameters. These parameters will be added to the FormIt snippet call, for example \'&formTpl=`customFormTpl`\'.';
$_lang['formalicious.advanced.parameters.create']               = 'Create Parameter';
$_lang['formalicious.advanced.parameters.update']               = 'Update Parameter';
$_lang['formalicious.advanced.parameters.remove']               = 'Remove Parameter';
$_lang['formalicious.advanced.parameters.remove_confirm']       = 'Are you sure you want to remove this parameter?';

$_lang['formalicious.advanced.parameters.label_key']            = 'Parameter Key';
$_lang['formalicious.advanced.parameters.label_key_desc']       = '';
$_lang['formalicious.advanced.parameters.label_value']          = 'Parameter Value';
$_lang['formalicious.advanced.parameters.label_value_desc']     = '';

$_lang['formalicious.default_view']                             = 'Default View';
$_lang['formalicious.admin_view']                               = 'Admin View';
$_lang['formalicious.back_to_forms']                            = 'Back to Forms';
$_lang['formalicious.active_step']                              = 'Active Step';
$_lang['formalicious.new_step']                                 = 'New Step';
$_lang['formalicious.no_forms']                                 = 'Please add some categories for your forms. Click on "Admin view" to manage the categories.';
$_lang['formalicious.form_err_ae']                              = 'A form with the same name already exists, specify another name.';
$_lang['formalicious.form_err_posthooks']                       = 'The spam, email and redirect hooks are added automatic to the the FormIt snippet call by Formalicious. No need to specify them here.';
$_lang['formalicious.form_not_exists']                          = 'Form with the ID "[[+id]]" was not found.';
$_lang['formalicious.formit_view_form']                         = 'View in FormIt';

$_lang['formalicious.submit']                                   = 'Submit';
$_lang['formalicious.next']                                     = 'Next';
$_lang['formalicious.prev']                                     = 'Previous';

$_lang['formalicious.contentblocks_input']                      = 'Formalicious Form Selector';
$_lang['formalicious.contentblocks_input.description']          = 'Allows you to select one of your created forms to insert into the content.';
