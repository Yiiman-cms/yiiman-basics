var contt=new class {
    input_content_type;
    input_url;
    input_hyper_url;

    constructor() {
        this.init();
    }

    init() {
        this.init_elements();
        this.init_triggers();
        this.check_content_type();
    }

    init_elements() {
        this.input_content_type = $('#menu-menucontenttype');
        this.input_url = $('#menu-url');
        this.input_hyper_url = $('#menu-hyper_url');
    }


    init_triggers() {
        this.trigger_content_type();
    }

    disable_url() {
        this.input_url.closest('.field-menu-url').css('display','none');
        this.input_url.val('');
    }

    enable_url(label='') {
        if (label.length>0){
            this.input_url.closest('.field-menu-url').find('label').text(label);
        }
        this.input_url.closest('.field-menu-url').css('display', 'block');
    }


    enable_hyper_url() {
        this.input_hyper_url.closest('.field-menu-hyper_url').css('display', 'block');
    }

    disable_hyper_url() {
        this.input_hyper_url.closest('.field-menu-hyper_url').css('display', 'none');
        this.input_hyper_url.val('');
    }


    check_content_type(){
        switch (this.input_content_type.val()){
            case "0":
                this.disable_hyper_url();
                this.disable_url();
                break;
            case 'url':
                this.enable_hyper_url();
                this.disable_url()
                break;
            default:
                this.enable_url();
                this.enable_hyper_url();
        }
    }

    size (obj) {
        var size = 0,
            key;
        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }
        return size;
    };

    trigger_content_type() {
        var app = this;
        this.input_content_type.off();
        this.input_content_type.change(function () {
            switch ($(this).val()) {
                case "0":
                    app.disable_hyper_url();
                    app.disable_url();
                    break;
                case 'url':
                    app.disable_url();
                    app.enable_hyper_url();
                    break;
                default:
                    $.ajax({
                        url: backend + '/menumodern/default/related-data',
                        type: 'POST',
                        dataType: 'json',
                        data: {type: app.input_content_type.val()},
                        success: function (data) {
                            app.disable_hyper_url();
                            app.enable_url(data.label);
                            app.input_url.empty();
                            app.input_url.append('<option value="" data-select2-id="2">انتخاب کنید...</option>');

                            if (app.size(data.data) > 0) {

                                $.each(data.data, function (index, value) {
                                    app.input_url.append('<option value="'+index+'" data-select2-id="'+index+'">'+value+'</option>');
                                });
                            }
                        }

                    })
            }
        });
    }
}