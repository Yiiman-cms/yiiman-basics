if (!RedactorPlugins) var RedactorPlugins = {};

(function ($) {
    RedactorPlugins.fontfamily = function () {
        return {
            init: function () {
                var fonts =
                    [
                        'IRANSans',
                        'iranyekan',
                        'iransharp',
                        'Aviny',
                        'Mahboobeh',
                        'Shabnam',
                        'Vazir',
                        'Naskh',
                        'Dubai',
                        'Dastnevis',
                        'Sahel',
                        'Lalezar',
                        'Platinosans',
                        'Myriad',
                        'Neirizi',
                        'Gandom',
                        'roboto'
                    ];
                var that = this;
                var dropdown = {};

                $.each(fonts, function (i, s) {
                    dropdown['s' + i] = {
                        title: s, func: function () {
                            that.fontfamily.set(s);
                        }
                    };
                });

                dropdown.remove = {title: 'حذف قلم از متن انتخاب شده', func: that.fontfamily.reset};

                var button = this.button.add('fontfamily', 'تغییر قلم متن');
                this.button.addDropdown(button, dropdown);

            },
            set: function (value) {
                this.inline.format('span', 'style', 'font-family:' + value + ';');
            },
            reset: function () {
                this.inline.removeStyleRule('font-family');
            }
        };
    };
})(jQuery);
