var paramModal = new class {
    modalCreated = false;
    key = '';

    constructor(){
        this.init();
    }

    init() {
        this.init_modal();
    }

    start() {
        this.key = editorMirror.getRange(editorMirror.getCursor(true), editorMirror.getCursor(false));
        this.modal_open();
        this.init_triggers();
    }

    modal_open() {
        $('#rendercontent').hide();
        $('#AddparameterModal').modal('show');
        $('#AddparameterModal').on('hide.bs.modal',function(){
            $('#rendercontent').show();
        });

    }

    modal_hide() {
        $('#AddparameterModal').modal('hide');
    }

    init_triggers() {
        this.trigger_submit();
    }

    valid_form() {
        var value = $('#parameterValue').val();
        if (value.length === 0) {
            sweetAlert({
                title: 'خطا',
                text: 'لطفا مقدار پارامتر را مشخص کنید',
                icon: "warning"
            })
            return false;
        } else {
            return true;
        }
    }

    trigger_submit() {
        var app = this;
        $('#parameterSubmit').off();
        $('#parameterSubmit').click(function (e) {
            e.preventDefault();
            if (app.valid_form()) {
                var key = app.key;
                key = key.replace(' ', '');
                key = key.replace('{{', '');
                key = key.replace('}}', '');
                key = key.replace('-', '');
                $.ajax({
                    url: parameterValueAddUrl,
                    method: 'post',
                    data: {
                        'key': key,
                        'description': $('#parameterDescription').val(),
                        'val': $('#parameterValue').val()
                    },
                    success: function (res) {
                        if (res.status === 'ok') {
                            sweetAlert({
                                title: 'موفق',
                                text: 'پارامتر با موفقیت مقداردهی و ثبت شد',
                                icon: "success"
                            });
                            app.modal_hide();


                            editorMirror.replaceRange(app.key, editorMirror.getCursor(true), editorMirror.getCursor(false), '{{' + key + '}}');

                        }
                    }
                });
            }
        });
    }

    init_modal() {
        if (!this.modalCreated) {
            $('body').prepend(this.modal_html());

            this.modalCreated = true;
        }
    }

    modal_html() {
        return `
<div class="modal" tabindex="-1" id="AddparameterModal" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">افزودن پارامتر جدید به سیستم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
                <div class="form-group">
                    <label for="parameterValue">مقدار پارامتر را ثبت کنید</label>
                    <input class="form-control" type="text" id="parameterValue">
                </div>
                <div class="form-group">
                    <label for="parameterDescription">توضیحات پارامتر(اختیاری)</label>
                    <input class="form-control" type="text" id="parameterDescription">
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="parameterSubmit">ذخیره پارامتر</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف و بستن</button>
              </div>
            </div>
          </div>
</div>


        `;
    }

}
