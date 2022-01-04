/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

$(document).ready(function () {
   $('.viewhere').click(function (e) {
       e.preventDefault();
       let src=$(this).attr('href');
       $('.modal .modal-body').html('<iframe src="'+src+'"></iframe>');
       $('.modal').modal('show');

   })
});
