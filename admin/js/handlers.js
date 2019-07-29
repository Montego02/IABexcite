
//
//function getCursorPos()
//{
//    var ctl = document.getElementById('Javascript_example');
//    var startPos = ctl.selectionStart;
//    var endPos = ctl.selectionEnd;
//    alert(startPos + ", " + endPos);
//}



// set menu entry active
var comp = getParameterByName('comp'); // get actual query string
if (comp) {

    $('#menu a').each(function () {
        if ($(this).attr('href').indexOf(comp) > 0) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
}


// Detail View Standard Handlers
$('#save').click(function () {
    var action = $('#formDetail').attr('action') + "save"; // formulate correct form action
    $('#formDetail').attr('action', action); // set form action
    $('#formDetail').submit();
});


$('#delete').click(function () {
    r = confirm("Möchten Sie den Eintrag " + $('#id').val() + " wirklich endgültig löschen?");
    if (r) {
        var action = $('#formDetail').attr('action') + "delete"; // formulate correct form action
        $('#formDetail').attr('action', action); // set form action
        $('#formDetail').submit();
    }
});


$('#deleteSelection').click(function () {
    r = confirm("Möchten Sie die gewählten Einträge wirklich endgültig löschen?");
    if (r) {
        var action = $('#formList').attr('action') + "deleteList"; // formulate correct form action
        $('#formList').attr('action', action); // set form action
        $('#formList').submit();
    }
});

$('#copySelection').click(function () {
    var action = $('#formList').attr('action') + "copySelection"; // formulate correct form action
    $('#formList').attr('action', action); // set form action
    $('#formList').submit();
});



$('i.status').click(function () {
    var id = $(this).closest('tr').attr('id'); // tr cotains attribute "id" that holds itemid
    $.ajax({url: "ajax.php?task=changeStatus",
        type: "POST",
        data: "comp=users&itemid=" + id + "&status=" + $(this).attr('value')})
            .done(function (msg) {

                console.log(msg);

            })
            //$('.selCategories').html(html);
            .fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });

})



$('#filter').change(function () {
    $('form').submit();
});












//keyboard handler
//$(document).keypress(function(e) {
//    if(e.which == 13) {
//        e.preventDefault();
//        false;
//        //$('#save').trigger('click'); // DONT save on enter!
//    }
//});



// datepicker    
$(function () {
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
    });
    //$(".datepicker").datepicker("setDate", "+0"); // set today as preset

});



// tablesorter
//
//$(function () {
//    $('.tablesorter').tablesorter(
//            {
//                headers: {
//                    //0: { sorter: false}, 
//                    ".status": {
//                        // disable sorting
//                        sorter: false
//                    },
//                    ".nosort": {
//                        // disable sorting
//                        sorter: false
//                    }
//
//                }
//            }
//    );
//});




function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}