$('.selectAll').click(function (e) {
    var targets = $(this).closest('table').find('tbody .selectOnce');
    var countSelections = targets.length;
    var selectedCount = 0;
    if (countSelections > 0) {
        $.each(targets, function (index, value) {
            if ($(this).prop('checked')) {
                selectedCount++;
            }
        })
    }


    if (selectedCount < countSelections) {
        $.each(targets, function (index, value) {
            $(this).prop('checked', true);
        });
        $(this).prop('checked',true)
    } else {
        $.each(targets, function (index, value) {
            $(this).prop('checked', false);
        })
        $(this).prop('checked',false)
    }
});

$('.selectOnce').click(function () {
    debugger;
    if (!$(this).prop('checked')) {
        $(this).closest('.table').find('.selectAll').prop('checked', false);
    } else {

        var targets = $(this).closest('table').find('tbody .selectOnce');
        var countSelections = targets.length;
        var selectedCount = 0;
        if (countSelections > 0) {
            $.each(targets, function (index, value) {
                if ($(this).prop('checked')) {
                    selectedCount++;
                }
            })
        }
        if (selectedCount === countSelections){
            $(this).closest('.table').find('.selectAll').prop('checked', true);
        }else{
            $(this).closest('.table').find('.selectAll').prop('checked', false);
        }
    }
})
$('.selectheader').click(function (){
    $('#'+$(this).attr('for')).click();
});


$(document).ready(function (){
    $.each($('.selectAll'),function (){
        var targets = $(this).closest('table').find('tbody .selectOnce');
        var countSelections = targets.length;
        var selectedCount = 0;
        if (countSelections > 0) {
            $.each(targets, function (index, value) {
                if ($(this).prop('checked')) {
                    selectedCount++;
                }
            })
        }


        if (selectedCount < countSelections) {
            $(this).prop('checked',false);
        } else {
            $(this).prop('checked',true);
        }
    })
});