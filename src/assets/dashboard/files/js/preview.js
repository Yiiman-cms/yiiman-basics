/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

function preview(that, id) {
    var file = that.files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        $('#' + id).html($('<img />').css('max-width', '100%').attr('src', reader.result));
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}