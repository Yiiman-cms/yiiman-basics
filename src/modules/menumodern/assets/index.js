/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

function initDelete() {
    $('.deleteElement').off();
    $('.deleteElement').click(function (e) {
        e.preventDefault();
        $('.menu-index').attr('remove','true');
        var text = $(this).attr('label');
        var tid = $(this).attr('tid');
        swal({
            title: "واقعا اطمینان دارید؟",
            text: "منوی " + text + " حذف شود؟ این عمل قابل بازگشت نیست.",
            icon: "warning",
            content: "Node",
            buttons: {confirm: "منوی " + text + " رو حذف کن", cancel: "نه حذف نکن!!"},
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var data = {tid: tid};
                    $.ajax({
                        url: backend+'menumodern/default/delete?id=' + tid,
                        type: 'post',
                        data: data,
                        beforeSend: function (data) {

                        }
                    }).done(function (data) {
                        if (data.status === 'ok') {
                            console.log($('[tid="' + data.tid + '"]'));
                            $('[tid="' + data.tid + '"]').remove();
                            swal("بسیار عالی، این منو حذف شد.", {
                                icon: "success",
                            });
                            $('.menu-index').attr('remove','false');
                        }
                    });

                } else {
                    $('.menu-index').attr('remove','false');
                    swal("خوب شد! شما حذف منو رو لغو کردید...",
                        {
                            timer:3000,
                            buttons:false
                        }
                        );
                }
            });

    });
}
function isEmpty( el ){
    return !$.trim(el.html());
}
function initTargets() {
    $.each($('[delete=""]'), function (index, value) {

        var tid = $(value).attr('tid');
        var label = $(value).attr('label');
        $(value).append('<span class="deleteElement" tid="' + tid + '" label="' + label + '" toggle="tooltip" title="حذف منوی '+label+' از بانک داده"><i class="fa fa-trash" ></i></span>');
    });
    $.each($('.tab-content'),function(index,value){
         // console.log(isEmpty($(value)));
        if ($(value).is(':empty')){
            // $(value).parent().parent().parent().parent().prev().attr('tid');
            $(value).append('<a class="addRight"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-home" aria-selected="true" tid="" label="" mode="detail" toggle="tooltip" title="افزودن یک تب به این منوی خالی " addRight>' +
                '<i class="fa fa-plus" ></i>' +
                '</a>');
        }
    });
    $.each($('[right=""]'), function (index, value) {
        var tid = $(value).attr('tid');
        var label = $(value).attr('label');
        if ($('[right=""]')[index+1]===undefined ||$('[right=""]')[index+1].length===0) {
            $(value).after('<a class="addRight"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-home" aria-selected="true" tid="" label="" mode="detail" toggle="tooltip" title="افزودن یک منو آخر لیست تب ها " addRight>' +
                '<i class="fa fa-plus" ></i>' +
                '</a>');
        }
            $(value).append('<a class="addRightChild"  data-toggle="pill" href="#" role="tab" aria-controls="v-pills-home" aria-selected="true" tid="'+tid+'" label="" mode="detail" toggle="tooltip" title="افزودن یک منو روبروی '+label+'" addRight>' +
                '<i class="fa fa-plus" ></i>' +
                '</a>');


    });


    $.each($('[addparent]'), function (index, value) {

        var data = $(this).attr('addparent');
        var tid = $(value).attr('tid');
        var label = $(value).attr('label');
        $(value).parent().parent().append('<li  class="dropdown addnew mega-dropdown open" toggle="tooltip" title="یک منوی اصلی در اینجا میسازد" data=\'' + data + '\' aria-expanded="false"><a href="#"><i class="fa fa-plus"></i></a></li>');
         $(value).parent().parent().append('<li  class="dropdown addnew mega-dropdown open drag" toggle="tooltip" title="برای جابجایی منوها، از اینجا درگ کنید"><a style="border-radius: 5px 0 0 5px;" href="#"><img width="15" height="15" src="'+ruleUrl+'" alt=""></a></li>');

    });

    $('[addparent]').click(function(){
        $(this).trigger('stop');
       var data=$(this).attr('addparent');
        $.ajax({
            url: backend+'menumodern/default/create',
            type: 'get',
            data: data,
            beforeSend: function (data) {

            }
        }).done(function (data) {
            $('#modal .modal-body').html(data);
            $('#modal ').modal('show');
        });
    });
    // $.each($('[edit=""]'), function (index, value) {
    //     var tid = $(value).attr('tid');
    //     $(value).append('<span class="editElement" tid="' + tid + '"><i class="fa fa-edit " ></i></span>');
    // });

    $('.addnew').click(function (e) {
        $(this).trigger('stop');
        var data = $.parseJSON($(this).attr('data'));
        $.ajax({
            url: backend+'menumodern/default/create',
            type: 'get',
            data: data,
            beforeSend: function (data) {

            }
        }).done(function (data) {
            $('#modal .modal-body').html(data);
            $('#modal ').modal('show');
        });
    });
    $('#modal').on('hidden',function(){
        $('.menu-index').attr('new','false');
    });
    $('.addRightChild').click(function (e) {
        $('.menu-index').attr('new','true');
        var data = {id:$(this).attr('tid')};

        $.ajax({
            url: backend+'menumodern/default/create',
            type: 'get',
            data: data,
            beforeSend: function (data) {

            }
        }).done(function (data) {
            $('#modal .modal-body').html(data);
            $('#modal ').modal('show');
            $('.menu-index').attr('new','false');
        });
    });




    $('.addRight').click(function (e) {
        var parrentTid=$(this).parent().parent().parent().parent().prev().attr('tid');
         console.log('p');
         console.log(parrentTid);
        $('.menu-index').attr('new','true');
        var data = {type:'tabmenu',tid:parrentTid};

        $.ajax({
            url: backend+'menumodern/default/create',
            type: 'get',
            data: data,
            beforeSend: function (data) {

            }
        }).done(function (data) {
            $('#modal .modal-body').html(data);
            $('#modal ').modal('show');
            $('.menu-index').attr('new','false');
        });
    });


    initDelete();
    $('[tid]').click(function (e) {
        var $this=$(this);
        e.preventDefault();
        setTimeout(function(){
            var remove=$('.menu-index').attr('remove');
            var newf=$('.menu-index').attr('new');
            if (  remove === 'false' && newf ==='false'){
                var tid =  $this.attr('tid');
                var data = {};
                $.ajax({
                    url: backend+'menumodern/default/update?id=' + tid,
                    type: 'post',
                    data: data,
                    beforeSend: function (data) {

                    }
                }).done(function (data) {
                    $('#modal .modal-body').html(data);
                    $('#modal').modal('show');
                });
            }
        });

    });

    $('.create').click(function (e) {
        e.preventDefault();
        var data = {};
        $.ajax({
            url: backend+'menumodern/default/create',
            type: 'get',
            data: data,
            beforeSend: function (data) {

            }
        }).done(function (data) {
            $('#modal .modal-body').html(data);
            $('#modal').modal('show');
        });
    });

    $('.publish').click(function (e) {
        e.preventDefault();
        swal({
            title: "واقعا اطمینان دارید؟",
            text: "همه ی تغییراتی که اینجا روی منوها اعمال کردید در سایت برای عموم منتشر خواهد شد و قابل بازگشت نخواهد بود." ,
            icon: "warning",
            content: "Node",
            buttons: {confirm: "منتشر کن", cancel: "نه منتشر نکن!!"},
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: backend+'menumodern/default/publish',
                        type: 'post',
                        beforeSend: function (data) {

                        }
                    }).done(function (data) {
                        if (data.status === 'ok') {

                            swal("بسیار عالی، تغییرات منتشر شد.", {
                                icon: "success",
                            });
                            $('.menu-index').attr('remove','false');
                        }
                    });

                } else {
                    $('.menu-index').attr('remove','false');
                    swal("خوب شد! شما تغییرات رو منتشر نکردید...",
                        {
                            timer:3000,
                            buttons:false
                        }
                    );
                }
            });
    });





    //dragble
    var draggable = $('.nav.navbar-nav'); //element


   draggable.draggable();
    draggable.on('drag',function(){
        $('.menu-index').attr('new','true');

    });
     draggable.on('stop',function(){

         setTimeout(function(){

             $('.menu-index').attr('new','false');
         },3000);

    });

}

$(document).ready(function () {
    initTargets();
    $('[toggle="tooltip"]').tooltip();
});

