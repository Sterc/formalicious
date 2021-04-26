Formalicious.panel.Update = function(config) {
    config = config || {};

    var settings = [];

    if (parseInt(Formalicious.config.save_forms) === 1 || Formalicious.config.save_forms) {
        settings.push({
            xtype           : 'checkbox',
            boxLabel        : _('formalicious.settings.label_saveform'),
            name            : 'saveform',
            inputValue      : 1
        }, {
            xtype           : 'label',
            html            : _('formalicious.settings.label_saveform_desc'),
            cls             : 'desc-under',
            width           : 500,
            style           : 'margin-left: 155px'
        });
    }

    var tabs = [{
        title           : _('formalicious.settings'),
        items           : [{
            html            : '<p>' + _('formalicious.settings.desc') + '</p>',
            bodyCssClass    : 'panel-desc'
        }, {
            xtype           : 'panel',
            layout          : 'form',
            cls             : 'main-wrapper',
            labelWidth      : 150,
            labelSeparator  : '',
            items           : [{
                xtype           : 'hidden',
                name            : 'category_id'
            }, {
                xtype           : 'textfield',
                fieldLabel      : _('formalicious.settings.label_name'),
                description     : MODx.expandHelp ? '' : _('formalicious.settings.label_name_desc'),
                name            : 'name',
                width           : 500,
                allowBlank      : false,
                enableKeyEvents : true,
                listeners       : {
                    'keyup'         : {
                        fn              : function(tf) {
                            this.onUpdateTitle(tf.getValue());
                        },
                        scope           : this
                    }
                }
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_name_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, {
                xtype           : 'formalicious-combo-resources',
                fieldLabel      : _('formalicious.settings.label_redirectto'),
                description     : MODx.expandHelp ? '' : _('formalicious.settings.label_redirectto'),
                name            : 'redirectto',
                width           : 500,
                default         : 0
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_redirectto_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, {
                xtype           : 'checkbox',
                boxLabel        : _('formalicious.settings.label_published'),
                name            : 'published',
                inputValue      : 1
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_published_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, {
                xtype           : 'xdatetime',
                fieldLabel      : _('formalicious.settings.label_published_from'),
                name            : 'published_from',
                width           : 500,
                allowBlank      : true,
                dateFormat      : MODx.config.manager_date_format,
                timeFormat      : MODx.config.manager_time_format,
                startDay        : parseInt(MODx.config.manager_week_start),
                offset_time     : MODx.config.server_offset_time
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_published_from_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, {
                xtype           : 'xdatetime',
                fieldLabel      : _('formalicious.settings.label_published_till'),
                name            : 'published_till',
                width           : 500,
                allowBlank      : true,
                dateFormat      : MODx.config.manager_date_format,
                timeFormat      : MODx.config.manager_time_format,
                startDay        : parseInt(MODx.config.manager_week_start),
                offset_time     : MODx.config.server_offset_time
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_published_till_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, settings]
        }, {
            html            : '<p>' + _('formalicious.settings.email.desc') + '</p>',
            bodyCssClass    : 'panel-desc'
        }, {
            xtype           : 'panel',
            layout          : 'form',
            cls             : 'main-wrapper',
            labelWidth      :  150,
            defaults        : {
                labelSeparator  : '',
            },
            items           : [{
                xtype           : 'xcheckbox',
                boxLabel        : _('formalicious.settings.label_email'),
                name            : 'email',
                id              : 'email',
                inputValue      : 1,
                listeners       : {
                    'check'         : {
                        fn              : this.onHideEmail,
                        scope           : this
                    },
                    'afterrender'   : {
                        fn              : this.onHideEmail,
                        scope           : this
                    }
                }
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_email_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, {
                xtype           : 'fieldset',
                id              : 'x-fieldset-email',
                hideMode        : 'offsets',
                autoHeight      : true,
                hidden          : true,
                items           : [{
                    xtype           : 'textfield',
                    fieldLabel      : _('formalicious.settings.label_emailto'),
                    name            : 'emailto',
                    regex           : /^(([a-zA-Z0-9_\+\.\-]+)@([a-zA-Z0-9_.\-]+)\.([a-zA-Z]{2,5}){1,25})+([;,.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*$/,
                    width           : 500
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_emailto_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'textfield',
                    fieldLabel      : _('formalicious.settings.label_emailsubject'),
                    name            : 'emailsubject',
                    width           : 500
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_emailsubject_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'textarea',
                    fieldLabel      : _('formalicious.settings.label_emailcontent'),
                    name            : 'emailcontent',
                    width           : 500,
                    listeners   : {
                        afterrender : {
                            fn          : function(event) {
                                if (Formalicious.loadRTE) {
                                    Formalicious.loadRTE(event.id, {
                                        plugins     : MODx.config['formalicious.editor_plugins'],
                                        menubar     : MODx.config['formalicious.editor_menubar'],
                                        statusbar   : parseInt(MODx.config['formalicious.editor_statusbar']) === 1,
                                        toolbar1    : MODx.config['formalicious.editor_toolbar1'],
                                        toolbar2    : MODx.config['formalicious.editor_toolbar2'],
                                        toolbar3    : MODx.config['formalicious.editor_toolbar3'],
                                        height      : 150
                                    });
                                }
                            }
                        }
                    }
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_emailcontent_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }]
            }]
        }, {
            html            : '<p>' + _('formalicious.settings.fair.desc') + '</p>',
            bodyCssClass    : 'panel-desc'
        }, {
            xtype           : 'panel',
            layout          : 'form',
            cls             : 'main-wrapper',
            labelWidth      :  150,
            defaults        : {
                labelSeparator  : '',
            },
            items           : [{
                xtype           : 'xcheckbox',
                boxLabel        : _('formalicious.settings.label_fiaremail'),
                name            : 'fiaremail',
                id              : 'fiaremail',
                inputValue      : 1,
                listeners       : {
                    'check'         : {
                        fn              : this.onHideAutoReplyEmail,
                        scope           : this
                    },
                    'afterrender'   : {
                        fn              : this.onHideAutoReplyEmail,
                        scope           : this
                    }
                }
            }, {
                xtype           : 'label',
                html            : _('formalicious.settings.label_fiaremail_desc'),
                cls             : 'desc-under',
                width           : 500,
                style           : 'margin-left: 155px'
            }, {
                xtype           : 'fieldset',
                id              : 'x-fieldset-fiaremail',
                hideMode        : 'offsets',
                autoHeight      : true,
                hidden          : true,
                padding         : 0,
                items           : [{
                    xtype           : 'formalicious-combo-fields',
                    fieldLabel      : _('formalicious.settings.label_fiaremailto'),
                    name            : 'fiaremailto',
                    width           : 500,
                    formId          : MODx.request.id
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_fiaremailto_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'textfield',
                    fieldLabel      : _('formalicious.settings.label_fiaremailfrom'),
                    name            : 'fiaremailfrom',
                    width           : 500,
                    vtype           : 'email'
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_fiaremailfrom_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'textfield',
                    fieldLabel      : _('formalicious.settings.label_fiaremailsubject'),
                    name            : 'fiaremailsubject',
                    width           : 500
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_fiaremailsubject_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'textarea',
                    fieldLabel      : _('formalicious.settings.label_fiaremailcontent'),
                    name            : 'fiaremailcontent',
                    width           : 500,
                    listeners       : {
                        afterrender     : {
                            fn              : function(event) {
                                if (Formalicious.loadRTE) {
                                    Formalicious.loadRTE(event.id, {
                                        plugins     : MODx.config['formalicious.editor_plugins'],
                                        menubar     : MODx.config['formalicious.editor_menubar'],
                                        statusbar   : parseInt(MODx.config['formalicious.editor_statusbar']) === 1,
                                        toolbar1    : MODx.config['formalicious.editor_toolbar1'],
                                        toolbar2    : MODx.config['formalicious.editor_toolbar2'],
                                        toolbar3    : MODx.config['formalicious.editor_toolbar3'],
                                        height      : 150
                                    });
                                }
                            }
                        }
                    }
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_fiaremailcontent_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'modx-combo-browser',
                    fieldLabel      : _('formalicious.settings.label_fiaremailattachment'),
                    name            : 'fiaremailattachment',
                    width           : 500,
                    source          : MODx.config['formalicious.source'],
                    id              : 'fiaremailattachment',
                    listeners       : {
                        'select'        : {
                            fn              : function(tf) {
                                Ext.getCmp('fiaremailattachment').setValue(tf.fullRelativeUrl);
                            }
                        }
                    }
                }, {
                    xtype           : 'label',
                    html            : _('formalicious.settings.label_fiaremailattachment_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }]
            }]
        }]
    }];

    if (Formalicious.config.permissions.tab_fields) {
        tabs.push({
            title       : _('formalicious.steps'),
            xtype       : 'formalicious-panel-update-form',
            disabled    : MODx.request.id ? false : true
        });
    }

    if (Formalicious.config.permissions.tab_advanced) {
        tabs.push({
            title           : _('formalicious.advanced'),
            items           : [{
                html            : '<p>' + _('formalicious.advanced.desc') + '</p>',
                bodyCssClass    : 'panel-desc'
            }, {
                xtype           : 'panel',
                layout          : 'form',
                cls             : 'main-wrapper',
                labelWidth      : 150,
                labelSeparator  : '',
                items           : [{
                    xtype           : 'textfield',
                    fieldLabel      : _('formalicious.advanced.label_prehooks'),
                    name            : 'prehooks',
                    width           : 500
                }, {
                    xtype           : 'label',
                    text            : _('formalicious.advanced.label_prehooks_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }, {
                    xtype           : 'textfield',
                    fieldLabel      : _('formalicious.advanced.label_posthooks'),
                    name            : 'posthooks',
                    width           : 500
                }, {
                    xtype           : 'label',
                    text            : _('formalicious.advanced.label_posthooks_desc'),
                    cls             : 'desc-under',
                    width           : 500,
                    style           : 'margin-left: 155px'
                }]
            }, {
                html            : '<p>' + _('formalicious.advanced.parameters.desc') + '</p>',
                bodyCssClass    : 'panel-desc'
            }, {
                xtype           : 'formalicious-grid-advanced-params',
                preventRender   : true,
                cls             : 'main-wrapper'
            }]
        });
    }

    Ext.apply(config, {
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : MODx.request.id ? 'mgr/forms/update' : 'mgr/forms/create',
            id          : MODx.request.id
        },
        id          : 'formalicious-panel-update',
        cls         : 'container',
        items       : [{
            html        : '<h2>' + _('formalicious') + '</h2>',
            cls         : 'modx-page-header',
            id          : 'formalicious-page-header'
        }, {
            xtype       : 'modx-tabs',
            items       : tabs
        }],
        listeners   : {
            'setup'     : {
                fn          : this.onSetup,
                scope       : this
            },
            'success'   : {
                fn          : this.onSuccess,
                scope       : this
            },
            'beforeSubmit' : {
                fn          : this.onBeforeSubmit,
                scope       : this
            }
        }
    });

    Formalicious.panel.Update.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.panel.Update, MODx.FormPanel, {
    initialized: false,

    onSetup: function() {
        if (!this.initialized) {
            if (MODx.request.id) {
                this.onUpdateTitle(this.record.name);

                this.getForm().setValues(this.record);

                var grid = Ext.getCmp('formalicious-grid-advanced-params');

                if (grid) {
                    grid.getStore().removeAll(true);

                    if (!Ext.isEmpty(this.record.parameters)) {
                        Ext.each(this.record.parameters, (function(value, index) {
                            grid.getStore().insert(index, new grid.Record({
                                key     : value.key,
                                value   : value.value
                            }));
                        }).bind(this));
                    }
                }
            } else {
                this.getForm().setValues({
                    category_id : MODx.request.category
                });
            }

            this.initialized = true;
        }

        this.fireEvent('ready');
    },
    onSuccess: function(object) {
        if (!MODx.request.id) {
            MODx.loadPage('update', 'namespace=' + MODx.request.namespace + '&id=' + object.result.object.id);
        }
    },
    onBeforeSubmit: function(object) {
        var grid = Ext.getCmp('formalicious-grid-advanced-params');

        if (grid) {
            var parameters = [];

            Ext.pluck(grid.getStore().data.items, 'data').forEach(function (value) {
                parameters.push({
                    key     : value.key,
                    value   : value.value
                });
            });

            if (parameters.length > 0) {
                this.baseParams.parameters = Ext.encode(parameters);
            } else {
                this.baseParams.parameters = '';
            }
        } else {
            this.baseParams.parameters = '';
        }
    },
    onUpdateTitle: function(title) {
        Ext.getCmp('formalicious-page-header').getEl().update('<h2>' + _('formalicious.form') + ': ' + Ext.util.Format.stripTags(title) + '</h2>');
    },
    onHideEmail: function(tf, checked) {
        var wrapper = Ext.getCmp('x-fieldset-email');

        if (wrapper) {
            if (checked) {
                wrapper.show();
            } else {
                wrapper.hide();
            }
        }
    },
    onHideAutoReplyEmail: function(tf, checked) {
        var wrapper = Ext.getCmp('x-fieldset-fiaremail');

        if (wrapper) {
            if (checked) {
                wrapper.show();
            } else {
                wrapper.hide();
            }
        }
    }
});

Ext.reg('formalicious-panel-update', Formalicious.panel.Update);

Formalicious.grid.AdvancedParams = function(config) {
    config = config || {};

    config.tbar = [{
        text    : _('formalicious.advanced.parameters.create'),
        cls     : 'primary-button',
        handler : this.createParam,
        scope   : this
    }];

    var columns = [{
        header      : _('formalicious.advanced.parameters.label_key'),
        dataIndex   : 'key',
        width       : 250,
        fixed       : true
    }, {
        header      : _('formalicious.advanced.parameters.label_value'),
        dataIndex   : 'value',
        width       : 250,
    }];

    Ext.applyIf(config,{
        columns     : columns,
        id          : 'formalicious-grid-advanced-params',
        url         : Formalicious.config.connector_url,
        fields      : ['id', 'key', 'value'],
        mode        : 'local',
        autoHeight  : true
    });

    Formalicious.grid.AdvancedParams.superclass.constructor.call(this, config);

    this.Record = new Ext.data.Record.create(['key','value']);
};

Ext.extend(Formalicious.grid.AdvancedParams, MODx.grid.LocalGrid, {
    getMenu : function() {
        return [{
            text    : '<i class="x-menu-item-icon icon icon-edit"></i>' + _('formalicious.advanced.parameters.update'),
            handler : this.updateParam
        }, '-', {
            text    : '<i class="x-menu-item-icon icon icon-times"></i>' + _('formalicious.advanced.parameters.remove'),
            handler : this.removeParam
        }];
    },
    createParam : function(btn, e) {
        if (this.windowCreateParam) {
            this.windowCreateParam.destroy();
        }

        this.windowCreateParam = MODx.load({
            xtype       : 'formalicious-window-param-create',
            closeAction : 'close'
        });

        this.windowCreateParam.show(e.target);
    },
    updateParam : function(btn, e) {
        if (this.windowUpdateParam) {
            this.windowUpdateParam.destroy();
        }

        this.windowUpdateParam = MODx.load({
            xtype       : 'formalicious-window-param-update',
            closeAction : 'close',
            record      : this.menu.record,
        });

        this.windowUpdateParam.setValues(this.menu.record);
        this.windowUpdateParam.show(e.target);
    },
    removeParam : function(btn, e) {
        Ext.Msg.confirm(
            _('formalicious.advanced.parameters.remove'),
            _('formalicious.advanced.parameters.remove_confirm'),
            function(action) {
                if (action === 'yes') {
                    this.getStore().remove(this.getSelectionModel().getSelected());
                }
            }, this
        );
    },
    addRow : function(value, window) {
        if (value.id) {
            var record = this.getStore().getById(value.id);
        } else {
            var record = new (new Ext.data.Record.create(['id', 'key', 'value']))();

            this.getStore().add(record);
        }

        record.set('id', record.id);
        record.set('key', value.key);
        record.set('value', value.value);

        record.commit();

        if (window.config.success) {
            Ext.callback(window.config.success, window);
        }

        if (window.config.closeAction === 'close') {
            window.close();
        } else {
            window.hide();
        }
    }
});

Ext.reg('formalicious-grid-advanced-params', Formalicious.grid.AdvancedParams);

Formalicious.window.CreateParam = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        title       : _('formalicious.advanced.parameters.create'),
        fields      : [{
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.advanced.parameters.label_key'),
            name        : 'key',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            text        : _('formalicious.advanced.parameters.label_key_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.advanced.parameters.label_value'),
            name        : 'value',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            text        : _('formalicious.advanced.parameters.label_value_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.CreateParam.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.CreateParam, MODx.Window, {
    submit: function() {
        var form = this.fp.getForm();

        if (form.isValid() && this.fireEvent('beforeSubmit', form.getValues())) {
            Ext.getCmp('formalicious-grid-advanced-params').addRow(form.getValues(), this);
        }
    }
});

Ext.reg('formalicious-window-param-create', Formalicious.window.CreateParam);

Formalicious.window.UpdateParam = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        title       : _('formalicious.advanced.parameters.update'),
        fields      : [{
            xtype       : 'hidden',
            name        : 'id'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.advanced.parameters.label_key'),
            name        : 'key',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            text        : _('formalicious.advanced.parameters.label_key_desc'),
            cls         : 'desc-under'
        }, {
            xtype       : 'textfield',
            fieldLabel  : _('formalicious.advanced.parameters.label_value'),
            name        : 'value',
            anchor      : '100%',
            allowBlank  : false
        }, {
            xtype       : 'label',
            text        : _('formalicious.advanced.parameters.label_value_desc'),
            cls         : 'desc-under'
        }]
    });

    Formalicious.window.UpdateParam.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.window.UpdateParam, MODx.Window, {
    submit: function() {
        var form = this.fp.getForm();

        if (form.isValid() && this.fireEvent('beforeSubmit', form.getValues())) {
            Ext.getCmp('formalicious-grid-advanced-params').addRow(form.getValues(), this);
        }
    }
});

Ext.reg('formalicious-window-param-update', Formalicious.window.UpdateParam);

Formalicious.combo.Resources = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/resources/getlist'
        },
        fields      : ['id', 'pagetitle', 'context_key', 'context_name'],
        hiddenName  : 'redirectto',
        pageSize    : 15,
        valueField  : 'id',
        displayField : 'pagetitle',
        forceSelection : true,
        editable    : true,
        typeAhead   : true,
        enableKeyEvents : true,
        tpl         : new Ext.XTemplate('<tpl for=".">' +
            '<div class="x-combo-list-item">' +
                '{pagetitle:htmlEncode} - <span style="font-style: italic;">{context_name:htmlEncode} </span>' +
            '</div>' +
        '</tpl>')
    });

    Formalicious.combo.Resources.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.combo.Resources, MODx.combo.ComboBox);

Ext.reg('formalicious-combo-resources', Formalicious.combo.Resources);

Formalicious.combo.Fields = function(config) {
    config = config || {};

    Ext.applyIf(config, {
        url         : Formalicious.config.connector_url,
        baseParams  : {
            action      : 'mgr/fields/getlist',
            form_id     : config.formId || '-1',
            limit       : 0
        },
        fields      : ['id', 'title'],
        hiddenName  : 'fiaremailto',
        valueField  : 'id',
        displayField : 'title'
    });

    Formalicious.combo.Fields.superclass.constructor.call(this, config);
};

Ext.extend(Formalicious.combo.Fields, MODx.combo.ComboBox);

Ext.reg('formalicious-combo-fields', Formalicious.combo.Fields);
