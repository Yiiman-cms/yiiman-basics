$(document).ready(function () {
    class menuForm {
        init() {
            this.initElements();
            this.initTriggers();
            console.log('init');
        }

        initElements() {
            this.e_type = $('#menu-type');
            this.e_url = $('#menu-url');
            this.e_relative = $('#menu-related_id');
            this.g_url = $('.field-menu-url');
            this.g_slug = $('[name="Slug[slug]"]');
            this.g_relative = $('.field-menu-related_id');
            this.label_related = $('[for="menu-related_id"]');
            this.url_off();
            this.relative_off();
            this.validateType();
        }

        initTriggers() {
            this.trigger_type();
        }

        url_off() {
            this.g_url.hide();
        }

        url_on() {
            this.g_url.show();
        }

         slug_off() {
            $('.field-slug-slug').hide();
            $('.field-menu-title ').parent().removeClass('col-md-6');
            $('.field-menu-title ').parent().addClass('col-md-12');

        }

        slug_on() {
            $('.field-slug-slug').show();
            $('.field-menu-title ').parent().removeClass('col-md-12');
            $('.field-menu-title ').parent().addClass('col-md-6');
        }

        slug_reset(){
            this.g_slug.val('');
        }


        option_element(label, value = '') {
            return '<option value="' + value + '">' + label + '</option>'
        }

        relative_init(type) {
            console.log('ok');
            var data = {type: type};
            let app = this;
            $.ajax({
                url: relatedUrl,
                type: 'post',
                data: data,
                beforeSend: function (data) {

                }
            }).done(function (data) {
                app.e_relative.empty();
                app.e_relative.append(app.option_element('Select...'));
                $.each(data, function (value, label) {
                    app.e_relative.append(app.option_element(label, value));
                })
            });
            this.relative_on();
        }

        related_title(title) {
            eval('this.label_related.text(Menutypes.'+title+'.label);')
        }

        relative_on() {
            this.g_relative.show();
        }

        relative_off() {
            this.g_relative.hide();
        }

        trigger_type() {
            let app = this;
            this.e_type.off();
            this.e_type.change(function () {
                app.validateType();
            })
        }


        validateType() {
            var val = this.e_type.val();

            switch (val) {
                case "url":
                    // url
                    this.relative_off();
                    this.url_on();
                    this.slug_reset();
                    this.slug_off();
                    break;
                case "0":
                    this.url_off();
                    this.relative_off();
                    this.slug_on();
                    break;
                default:
                    // page
                    this.url_off();
                    this.relative_init(val);
                    this.related_title(val);
                    this.slug_on();
                    break;
            }
        }
    }

    let appForm = new menuForm();
    appForm.init();
});


