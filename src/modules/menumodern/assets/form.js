/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

var form =
    {
        address: $('#address'),
        id: $('#menu-id'),
        name: $('#menu-name'),
        link: $('#hyperl'),
        column: $('#columnL'),
        image: $('#imgL'),
        positions: $('#positions'),
        icon: $('#iconPack'),
        enable: $('#enable'),
        submit: $('#submitBtn'),
        parent: $('#parent'),
        right: $('#right'),
        child: $('#child'),
        child2: $('#child2'),
        type: $('#menu-menutype'),
        contentType: $('#menu-menucontenttype'),
    };
window.onload = menuType();

function menuType() {

    document.getElementById('imgL').style.display = 'none';


    switch (form.type.val()) {
        case 'parent':
            form.parent.css('display', 'none');
            form.right.css('display', 'none');
            form.child.css('display', 'none');
            form.child2.css('display', 'none');
            form.link.css('display', 'block');
            form.address.css('display', 'block');
            form.column.css('display', 'none');
            form.positions.css('display', 'block');
            form.icon.css('display', 'block');
            form.enable.css('display', 'block');
            form.submit.css('display', 'block');
            break;
        case 'right':
            console.log($('#menu-parent').val());
            if (form.type.val() === 'right' && $('#menu-parent').val() > 0) {
                form.parent.css('display', 'block');
                form.right.css('display', 'none');
                form.child.css('display', 'none');
                form.child2.css('display', 'none');
                form.link.css('display', 'block');
                form.address.css('display', 'block');
                form.column.css('display', 'block');
                form.positions.css('display', 'block');
                form.icon.css('display', 'block');
                form.enable.css('display', 'block');
                form.submit.css('display', 'block');
            } else {
                form.parent.css('display', 'block');
                form.right.css('display', 'none');
                form.child.css('display', 'none');
                form.child2.css('display', 'none');
                form.link.css('display', 'block');
                form.address.css('display', 'block');
                form.column.css('display', 'none');
                form.positions.css('display', 'none');
                form.icon.css('display', 'none');
                form.enable.css('display', 'none');
                form.submit.css('display', 'none');
            }
            break;
        case 'child':
            console.log($('#menu-parent').val());
            console.log($('#menu-right').val());
            if (form.type.val() === 'child' && $('#menu-parent').val() > 0 && $('#menu-right').val() > 0) {
                form.parent.css('display', 'block');
                form.right.css('display', 'block');
                form.child.css('display', 'none');
                form.child2.css('display', 'none');
                form.link.css('display', 'block');
                form.address.css('display', 'block');
                form.column.css('display', 'none');
                form.positions.css('display', 'block');
                form.icon.css('display', 'none');
                form.enable.css('display', 'block');
                form.submit.css('display', 'block');
            } else {
                form.parent.css('display', 'block');
                form.right.css('display', 'none');
                form.child.css('display', 'none');
                form.child2.css('display', 'none');
                form.link.css('display', 'none');
                form.address.css('display', 'none');
                form.column.css('display', 'none');
                form.positions.css('display', 'none');
                form.icon.css('display', 'none');
                form.enable.css('display', 'none');
                form.submit.css('display', 'none');
            }
            break;
        case 'child2':
            if (form.type.val() === 'child2' && $('#menu-parent').val() > 0 && $('#menu-right').val() > 0 && $('#menu-child').val() > 0) {
                form.parent.css('display', 'block');
                form.right.css('display', 'block');
                form.child.css('display', 'block');
                form.child2.css('display', 'block');
                form.link.css('display', 'block');
                form.address.css('display', 'block');
                form.column.css('display', 'none');
                form.positions.css('display', 'block');
                form.icon.css('display', 'none');
                form.enable.css('display', 'block');
                form.submit.css('display', 'block');
            } else if (form.type.val() === 'child2' && $('#menu-parent').val() > 0 && $('#menu-right').val() > 0) {
                form.parent.css('display', 'block');
                form.right.css('display', 'block');
                form.child.css('display', 'block');
                form.child2.css('display', 'none');
                form.link.css('display', 'none');
                form.address.css('display', 'none');
                form.column.css('display', 'none');
                form.positions.css('display', 'none');
                form.icon.css('display', 'none');
                form.enable.css('display', 'none');
                form.submit.css('display', 'none');
            } else if (form.type.val() === 'child2' && $('#menu-parent').val() > 0) {
                form.parent.css('display', 'block');
                form.right.css('display', 'none');
                form.child.css('display', 'none');
                form.child2.css('display', 'none');
                form.link.css('display', 'none');
                form.address.css('display', 'none');
                form.column.css('display', 'none');
                form.positions.css('display', 'none');
                form.icon.css('display', 'none');
                form.enable.css('display', 'none');
                form.submit.css('display', 'none');
            } else {
                form.parent.css('display', 'block');
                form.right.css('display', 'none');
                form.child.css('display', 'none');
                form.child2.css('display', 'none');
                form.link.css('display', 'none');
                form.address.css('display', 'none');
                form.column.css('display', 'none');
                form.positions.css('display', 'none');
                form.icon.css('display', 'none');
                form.enable.css('display', 'none');
                form.submit.css('display', 'none');
            }
            break;
    }
}

$('#modal button.btn-success').click(function (e) {

    var data = {};
    data.Menu = {};
    data.Menu.name = $('#menu-name').val();
    data.Menu.menuType = $('#menu-menutype').val();
    data.Menu.parent = $('#menu-parent').val();
    data.Menu.right = $('#menu-right').val();
    data.Menu.child = $('#menu-child').val();
    data.Menu.url = $('#menu-url').val();
    data.Menu.hyper_url = $('#menu-hyper_url').val();
    data.Menu.column = $('#menu-column').val();
    data.Menu.img = $('#menu-img').val();
    data.Menu.pos = $('#menu-pos').val();
    data.Menu.icon = $('.picker-element').val();
    data.Menu.enable = $('#menu-enable').val();
    data.Menu.menuContentType = $('#menu-menucontenttype').val();
    console.log(data);

    $.ajax({
        url: url,
        type: 'post',
        data: data,
        beforeSend: function (data) {

        }
    }).done(function (response) {
        if (response.status === 'ok') {
            var data = {};
            $.ajax({
                url: backend+'/menumodern/default/indexx',
                type: 'post',
                data: data,
                beforeSend: function (data) {

                }
            }).done(function (data) {
                swal({
                    icon: "success",
                    timer: 3000,
                    buttons: false,
                    text: 'در حال آماده سازی منوها'
                });
                $('#modal').modal('hide');
                $('.menu-index').trigger('reload');
            });
        }
    });

});

$('#menu-parent').on('change', function () {
    $('#menu-child').empty();
    $('#menu-right').empty();
    var id = $(this).val();
    var data = {type: "child", parent: id};
    $.ajax({
        url: backend+'/menumodern/default/parents',
        type: 'post',
        data: data,
        beforeSend: function (data) {

        }
    }).done(function (data) {

        var selectElement = $('#menu-right');
        selectElement.empty();
        $.each(data, function (index, value) {
            selectElement.append('<option id=' + index + ' value=' + index + '>' + value + '</option>');
        });
        menuType();
    });
});
$('#menu-right').on('change', function () {
    var id = $(this).val();
    var data = {type: "right", parent: id};
    $.ajax({
        url: backend+'/menumodern/default/parents',
        type: 'post',
        data: data,
        beforeSend: function (data) {

        }
    }).done(function (data) {

        var selectElement = $('#menu-child');
        selectElement.empty();
        $.each(data, function (index, value) {
            selectElement.append('<option id=' + index + ' value=' + index + '>' + value + '</option>');
        });
        menuType();

    });
});
$('#menu-child').on('change', function () {

    if ($('#menu-menutype').val() !== 'child2') {

        var id = $(this).val();
        var data = {type: "child", parent: id};
        $.ajax({
            url: backend+'/menumodern/default/parents',
            type: 'post',
            data: data,
            beforeSend: function (data) {

            }
        }).done(function (data) {

            var selectElement = $('#menu-child');
            selectElement.empty();
            $.each(data, function (index, value) {
                selectElement.append('<option id=' + index + ' value=' + index + '>' + value + '</option>');
            });
            menuType();

        });
    }
});

form.type.on('change', function (e) {
    $('#menu-right').empty();
    $('#menu-child').empty();
    $('#menu-child2').empty();
    menuType();
})