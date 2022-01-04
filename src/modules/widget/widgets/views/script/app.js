/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

function insertTextAtCursor(text) {
    var doc = editorMirror.getDoc();
    var cursor = doc.getCursor();
    doc.replaceRange(text, cursor);
}

var ComponentsApp = new class {
    constructor() {
        this.init();
    }

    insertTextAtCursor(text) {
        var doc = editorMirror.getDoc();
        var cursor = doc.getCursor();
        doc.replaceRange(text, cursor);
    }

    init() {

        $('#themecomponents-continer').toggle('hide');
        this.init_triggers();
    }

    init_triggers() {
        this.trigger_toggleHeader();
        this.trigger_components()
    }

    trigger_toggleHeader() {
        $('#themeComponentsTitle').off();
        $('#themeComponentsTitle').click(function () {
            $('#themecomponents-continer').toggle('slow');
        });
    }

    trigger_components() {
        var app = this;
        $('[data-name="ttpComponent"]').off();
        $('[data-name="ttpComponent"]').click(function () {
            $('#themecomponents-continer').toggle('hide');
            var name = 'components_' + $(this).attr('data-content');
            eval('app.insertTextAtCursor(' + name + ');');
        });
    }

    open_modal() {
        this.modal.modal('show');
    }

    close_modal() {
        this.modal.modal('hide');
    }


    //
    // init_parameters() {
    //     this.container_error = $('#');
    // }


    ajax(url, data, errorCallBack = function () {
    }) {
        var app = this;
        $.ajax({
            url: url,
            method: 'post',
            data: data,
            success: function (response) {
                app.checkResponse(response);
            },
            error: errorCallBack
        });

    }


    hideError() {
        this.container_error.empty();
    }

    addError(message) {
        this.container_error.append(`
            <li>` + message + `</li>
            `)
    }


    checkResponse(response) {
        var app = this;
        switch (response.status) {
            case 'error':
                this.addError(response.message);
                break;
            case 'errors':
                $.each(response.messages, function (index, value) {
                    app.addError(value);
                })
                break;
        }
    }

}



