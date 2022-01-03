jQuery(document).ready(function ($) {

    $('.close_icon').click(function (event) {
        $('.notif_box').hide();
    });

    $('#checked-code').click(function (event) {

        var dcode = $('#order-discountcode').val();

        if (!dcode || dcode == '' || typeof dcode == 'undefined') {
            alert('Code!');
            return false;
        }
        $('.discount-alert').hide();

        $.ajax({
            url: '/api/checkedcode',
            type: 'GET',
            dataType: 'json',
            data: {code: dcode, 'hash': $('#cart-hash').val()},
        })
            .done(function (data) {
                console.log("success", data);
                if (data.result == true) {
                    $('#discount-success').show();

                    setTimeout(function () {
                        window.location.reload(false);
                    }, 1000);


                } else if (data.result == false) {
                    $('#discount-error').show();
                }

                return false;
            })
            .fail(function (data) {
                console.log("error", data);
                return false;
            })
            .always(function () {
                return false;
                //console.log("complete");
            });

        return false;

    });


//   megamenu with hover
//    dropdown mega-dropdown
    $('.dropdown.mega-dropdown').mouseover(function () {
        $.each($('.dropdown.mega-dropdown'),function (index,value) {
           $(value).removeClass('open');
        });
        $(this).addClass('open');
    });
    $('.dropdown.mega-dropdown').mouseleave(function () {

        var dataId =$(this).attr('data-id');

        var $this=$(this);
        setTimeout(function () {
            if ($('.mega-dropdown[data-id="'+dataId+'"]:hover').length === 0) {
                $this.removeClass('open');
            }

        }, 500);
    });
    $('.dropdown-menu.pb0.mega-dropdown-menu').mouseover(function () {
        var dataId =$(this).attr('data-id');
        $('#megamenuHeader[data-id="'+dataId+'"]').parent().addClass('open');
    });
    $('.dropdown-menu.pb0.mega-dropdown-menu').mouseleave(function () {
        var dataId =$(this).attr('data-id');
        $('#megamenuHeader[data-id="'+dataId+'"]').parent().removeClass('open');
    });
    $('.nav-link.right-m').mouseover(function (e) {
        e.preventDefault();
        var navs = $('.nav-link');
        $.each(navs, function (i, v) {
            $(v).removeClass('active');
            $(v).attr('aria-selected', 'false');
            // $(v).tab('hide');
        });
        var tabs = $('.tab-pane');
        $.each(tabs, function (i, v) {
            $(v).removeClass('active');
            $(v).removeClass('in');
        });
        var target = $(this).attr('href');
        target = target.replace('#', '');
        $(this).addClass('active');
        $(this).attr('aria-selected', 'true');
        $('[id="' + target + '"]').addClass('active');
        $('[id="' + target + '"]').addClass('in');

    });
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        // console.log(e.target);
        // console.log(e.relatedTarget);
    });
    $('.nav-link').mouseleave(function (e) {
        if ($('.dropdown-menu.mega-dropdown-menu.shadowTwo.pb0v>.col-md-9:hover').length > 0) {
            e.preventDefault();
        } else {
            $('#megamenuHeader').parent().removeClass('open');
        }

    });
    $('.dropdown-toggle.prent').mouseover(function () {
        $(this).next().addClass('open');
        $(this).attr('aria-expanded', 'true');
        $('#megamenuHeader').parent().removeClass('open');
        // $(this).dropdown('toggle');
    });
    $('.dropdown-toggle.prent').mouseleave(function () {
        if ($('.dropdown-menu:hover').length === 0) {
            $(this).next().removeClass('open');
            $(this).attr('aria-expanded', 'false');
        }
    });
    $('.dropdown-menu').mouseleave(function () {
        $(this).removeClass('open');
        $(this).parent().attr('aria-expanded', 'false');
    });
    $('.dropdown-submenu').mouseover(function () {
        var index=$(this).attr('in');
        index = (parseInt(index)*40)-3;
        $(this).find('.dropdown-menu.child-parent').css('top',index+'px');
        $(this).find('.dropdown-menu.child-parent').addClass('open');
    });

    $('.dropdown-submenu').mouseleave(function () {
        $(this).find('.dropdown-menu.child-parent').removeClass('open');
    });


});

