/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

function scalerange() {
    $(".scale-range-group input").on('mousedown', function () {

        $(".scale-range-group input").on('mousemove', function () {
            let percent = $(".scale-range-group input").val();
            let scale = percent * 0.01;
            let nesbat = 100 / percent;
            $('#iframe1').css(
                {
                    "transform": "scale(" + scale + ")",
                    "width": (100 * nesbat) + "%",

                    "height": "calc(" + (100 * nesbat) + "vh - 100px)",


                    "margin-left": (percent - 100) + "%",
                    "margin-top": "calc(" + (percent - 100) + "% )"
                }
            );


            console.log(percent, scale, nesbat);
        });


    });
    $(".scale-range-group input").on('mouseup', function () {
        $(".scale-range-group input").off();
        scalerange();
    });
}

scalerange();