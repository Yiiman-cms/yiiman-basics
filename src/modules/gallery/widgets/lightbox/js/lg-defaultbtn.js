var defaultbtnSefaults = {
    checkDefaultUrl: '',
    setDefaultUrl: '',
};

function toCamelCase(input) {
    return input.toLowerCase().replace(/-(.)/g, function (match, group1) {
        return group1.toUpperCase();
    });
}

var Defaultbtn =  function Defaultbtn(element){

    this.el = element;

    this.core = window.lgData[this.el.getAttribute('lg-uid')];
    this.core.s = Object.assign({}, defaultbtnSefaults, this.core.s);

    // if (this.core.s.defaultbtn) {
    this.init();
    // }

    return this;
};

Defaultbtn.prototype.init = function () {

    var _this = this;

    var defaultbtnHtml = '<span data-toggle="tooltip" data-tippy-content="انتخاب به عنوان تصویر پیش فرض" type="button" aria-label="setDefault"  id="lg-defaultbtn" class="lg-icon"><i class="fa fa-heart-o"></i></span>';


    this.core.outer.querySelector('.lg-toolbar').insertAdjacentHTML('beforeend', defaultbtnHtml);
    this.core.outer.querySelector('.lg').insertAdjacentHTML('beforeend', '<div id="lg-dropdown-overlay"></div>');
    var defaultbtnButton = document.getElementById('lg-defaultbtn');
    utils.on(defaultbtnButton, 'click.lg', function (event) {
        var src=$('.lg-item.lg-loaded.lg-current .lg-img-wrap .lg-object.lg-image').attr('src');
        $.ajax({
            url: _this.core.s.setDefaultUrl,
            data: {src: src},
            method: 'post',
            success(data) {
                var el=$('[data-src="'+src+'"]');
                var id= $('[data-src="'+src+'"]').closest('.lightgallery-parent').attr('id');
                var settings= _this.core.s;
                var container=$('#'+id).find('li');

                $(defaultbtnButton).find('i').removeClass('fa-heart-o');
                $(defaultbtnButton).find('i').addClass('fa-heart');

                $('#'+id+' [data-src]').removeClass('default-pic');
                $('#'+id+' [data-src]').removeAttr('data-toggle');
                $('#'+id+' [data-src]').removeAttr('data-tippy-content');

                console.log($('#'+id+' [data-src]'));
                $('[data-src="'+src+'"]').addClass('default-pic');
                $('[data-src="'+src+'"]').attr('data-toggle','tooltip');
                $('[data-src="'+src+'"]').attr('data-tippy-content','پیش فرض انتخاب شده برای جلد');

                tippy('destroy');
                tippy('[data-toggle="tooltip"]');
                _this.core.destroy(true);

            }

        });
    });


    utils.on(_this.core.el, 'onAfterSlide.lgtm', function (event) {

        // setTimeout(function () {
        //     document.getElementById('lg-defaultbtn').setAttribute('data-id',  _this.getRemovePropsUrl(event.detail.index, 'data-facebook-share-url'));
        // }, 100);
    });
};


Defaultbtn.prototype.getDefaultbtnPropsUrl = function (index, prop) {
    var defaultbtnProp = this.getDefaultbtnProps(index, prop);
    if (!defaultbtnProp) {
        defaultbtnProp = window.location.href;
    }
    return encodeURIComponent(defaultbtnProp);
};


Defaultbtn.prototype.getDefaultbtnProps = function (index, prop) {
    var defaultbtnProp = '';
    if (this.core.s.dynamic) {
        defaultbtnProp = this.core.items[index][toCamelCase(prop.replace('data-', ''))];
    } else if (this.core.items[index].getAttribute(prop)) {
        defaultbtnProp = this.core.items[index].getAttribute(prop);
    }
    return defaultbtnProp;
};


Defaultbtn.prototype.destroy = function () {

};

window.lgModules.defaultbtn = Defaultbtn;
