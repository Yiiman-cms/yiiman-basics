var removeSefaults = {
    removeUrl: ''
};

function toCamelCase(input) {
    return input.toLowerCase().replace(/-(.)/g, function (match, group1) {
        return group1.toUpperCase();
    });
}

var Remove =  function Remove(element){

    this.el = element;

    this.core = window.lgData[this.el.getAttribute('lg-uid')];
    this.core.s = Object.assign({}, removeSefaults, this.core.s);

    // if (this.core.s.remove) {
        this.init();
    // }

    return this;
};

Remove.prototype.init = function () {

    var _this = this;

    var removeHtml = '<span type="button" aria-label="Remove"  id="lg-remove" class="lg-icon"><i class="fa fa-trash"></i></span>';


    this.core.outer.querySelector('.lg-toolbar').insertAdjacentHTML('beforeend', removeHtml);
    this.core.outer.querySelector('.lg').insertAdjacentHTML('beforeend', '<div id="lg-dropdown-overlay"></div>');
    var removeButton = document.getElementById('lg-remove');
    utils.on(removeButton, 'click.lg', function (event) {
        var src=$('.lg-item.lg-loaded.lg-current .lg-img-wrap .lg-object.lg-image').attr('src');
        $.ajax({
            url: _this.core.s.removeUrl,
            data: {src: src},
            method: 'post',
            success(data) {
                var el=$('[data-src="'+src+'"]');
                var id= $('[data-src="'+src+'"]').closest('.lightgallery-parent').attr('id');
                var settings= _this.core.s;
                var container=$('#'+id).find('li');

                $('.lg-backdrop').remove();
                $('.lg-outer.lg-start-zoom.lg-use-css3.lg-css3.lg-slide.lg-show-after-load.lg-use-transition-for-zoom.lg-visible.lg-grab.lg-hide-items').remove();
                $('[data-src="'+src+'"]').remove();
                _this.core.destroy(true);
                $.each(container,function(){
                    $(this).removeAttr('lg-event-uid');
                    $(this).off();
                });

                lightGallery(document.getElementById(id),settings);
            }

        });
    });


    utils.on(_this.core.el, 'onAfterSlide.lgtm', function (event) {

        // setTimeout(function () {
        //     document.getElementById('lg-remove').setAttribute('data-id',  _this.getRemovePropsUrl(event.detail.index, 'data-facebook-share-url'));
        // }, 100);
    });
};


Remove.prototype.getRemovePropsUrl = function (index, prop) {
    var removeProp = this.getRemoveProps(index, prop);
    if (!removeProp) {
        removeProp = window.location.href;
    }
    return encodeURIComponent(removeProp);
};


Remove.prototype.getRemoveProps = function (index, prop) {
    var removeProp = '';
    if (this.core.s.dynamic) {
        removeProp = this.core.items[index][toCamelCase(prop.replace('data-', ''))];
    } else if (this.core.items[index].getAttribute(prop)) {
        removeProp = this.core.items[index].getAttribute(prop);
    }
    return removeProp;
};


Remove.prototype.destroy = function () {

};

window.lgModules.remove = Remove;
