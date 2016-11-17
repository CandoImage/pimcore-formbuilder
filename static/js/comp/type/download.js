pimcore.registerNS("Formbuilder.comp.type.download");
Formbuilder.comp.type.download = Class.create(Formbuilder.comp.type.base,{

    type: "download",

    getTypeName: function () {
        return t("download");
    },

    getIconClass: function () {
        return "Formbuilder_icon_download";
    },

    onAfterPopulate: function(){

        var label = Ext.getCmp("fieldlabel");
        var description = Ext.getCmp("fielddescription");
        var allowempty = Ext.getCmp("fieldallowempty");
        var required = Ext.getCmp("fieldrequired");
        var value = Ext.getCmp("fieldvalue");

        allowempty.hide();
        required.hide();
        value.hide();

    },

    getForm: function($super){
        $super();

        var thisNode = new Ext.form.FieldSet({
            title: t("This node"),
            collapsible: true,
            defaultType: 'textfield',
            items:[
                {
                    fieldLabel: t("Asset"),
                    name: "asset",
                    cls: "input_drop_target",
                    value: this.datax.asset,
                    width: 600,
                    xtype: "textfield",
                    listeners: {
                        "render": function (el) {
                            new Ext.dd.DropZone(el.getEl(), {
                                reference: this,
                                ddGroup: "element",
                                getTargetFromEvent: function (e) {
                                    return this.getEl();
                                }.bind(el),
                                onNodeOver: function (target, dd, e, data) {
                                    return Ext.dd.DropZone.prototype.dropAllowed;
                                },
                                onNodeDrop: function (target, dd, e, data) {
                                    var record = data.records[0],
                                        data = record.data;

                                    if (data.elementType === "asset") {
                                        this.setValue(data.path);
                                        return true;
                                    }
                                    return false;
                                }.bind(el)
                            });
                        }
                    }
                },
                {
                    xtype: "label",
                    text: "Only Pimcore Assets are allowed. Just drag your Asset into the field above."
                }

            ]
        });

        this.form.add(thisNode);

        return this.form;
    }

});