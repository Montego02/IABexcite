
var path = basePath;
var trumboId = 0; // index id of active editor window

// MEDIA.js
// handles media uploads on all components
// handlers are general if not prefixed with component (f.e. .content .file)


$('body').on('click', '#folders .folder ', function () {
    console.log('folder clicked');
    path = $(this).attr('data-pth');
    $('input[name="path"]').val(path); // send path to hidden input for uploading new image
    scanFolder(path);
});


// content: file click -> show preview 
$('body').on('click', '.content .file ', function () {
    // delete old info
    //$('#files, #folders').empty();
    var filename = $(this).html();
    showPreview(path + "/" + filename);
});


// back to start
$('.btnBack').click(function (e) {
    e.preventDefault();
    path = basePath;

    resetPreview();

    scanFolder(basePath);
});


// save, which editor window is the active one
$('.trumbowyg-editor').click(function () {
    trumboId = $('.trumbowyg-editor').index($(this));
});


// content: 'einfügen' click
$('body').on('click', '.btnInsertImage ', function (e) {
    e.preventDefault();

    // trying to insert at cursor position:
    /*
     var cursorPos = localStorage.getItem('rangeStart');
     elemEditor = $('.trumbowyg-editor').eq(trumboId); // get the last selected editor window
     
     oldHtml = $('.trumbowyg-editor').eq(trumboId).html();
     console.log(oldHtml);
     var html = oldHtml.substring(1,cursorPos);
     html += $('#previewPic img');
     html += oldHtml.substring(cursorPos,elemEditor.html().length);
     */


    $('#settingsPic').addClass('hidden');

    // adjust image size to set size
    $('#previewPic img').css("width", $('#previewPic img').attr('data-width'));

    // just append for now ;)
    $('.trumbowyg-editor').eq(trumboId).append($('#previewPic img'));


    var range = trumbowyg.getRange();
    console.log('range: ' + range);

});



// handlers for media settings

$('#settingsPic i').click(function () {
    if (!$(this).hasClass('active')) {
        $('#settingsPic i').toggleClass('active');
        var classApplied = $(this).data('class');

        $('#previewPic img').removeClass('floatLeft floatRight');
        $('#previewPic img').addClass(classApplied);
    }


});

$('.imgSize').click(function (e) {
    var size = $(this).data('size');
    console.log(size);
    // set 
    $('#previewPic img').attr("data-width", size);

    // remove float for full sized pics
    if (size == "100%") {
        $('#previewPic img').removeClass('floatLeft floatRight');
    }


});



/*  Functions------------------------------   */


function scanFolder(path) {
    // delete old info
    resetPreview();

    if (!path) {
        path = '/';
    }
    console.log('scanning path: ' + path);

    $('#breadcrumbs').html(path);


    // load ref including pictures that are in ref[id] path 
    $.ajax({url: "ajaxController.php?task=scanDir1",
        dataType: "json",
        type: "POST",
        data: 'path=' + path})
            .done(function (items) {
                //  console.log(items);
                if (items.length > 2) {
                    listItems(items);
                } else {
                    // delete button if no files in folder
                    // only in MEDIA component
                    $('.media #files').append("<a class='btn btnDeleteFolder'><i class='icon-folder-minus' ></i> Ordner löschen</a> ");
                }

            })
            .fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
}


// list found folders/files
function listItems(items) {
    $.each(items, function (i, it) {
        if (it !== "." && it !== "..") {
            if (isDir(it)) {
                $('#folders').append("<a class='folder' data-pth='" + basePath + path + "/" + it + "'><i class='icon-folder2'></i> " + it + "</a> ");
            } else {
                // if (isImage(it)) { // show only images
                $('#files').append("<a class='file'>" + it + "</a> ");
                //  }
            }
        }
    });
}



function showPreview(path) {
    console.log('fullpath: ' + path);
    html = "<img src='../images/" + path + "' class='floatLeft' data-size='200px' />";
    $('#previewPic').html(html);
    // show settings
    $('#settingsPic').removeClass('hidden');
}



function resetPreview() {
    $('#files, #folders').empty();
    $('#previewPic').empty();
    $('#settingsPic').addClass('hidden');
}










/////////////////////////////////////////////////////////////
// upload image

$('#uploadImage').click(function (e) {
    e.preventDefault();
    if ($('#image').val()) {
        uploadImage();
    } else {
        alert('Bitte wählen Sie zunächst ein Bild aus.');
    }
});

function uploadImage() {

    // update path 
    $('input[name="folder"]').val($('#breadcrumbs').html());

    var file_data = $('#image').prop('files')[0];
    var form_data = new FormData($('#formDetail')[0]);
    form_data.append('image', file_data);

    $('#loader').html('<img src="/images/ajax-loader.gif">'); // show loader

    // 2 save image
    $.ajax({url: "ajaxController.php?task=saveImage",
        dataType: "json",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        data: form_data
    })

            .done(function (rtn) {
                console.log(rtn.msg);
                console.log(rtn.path);
                $('#images').html('');
                $('#loader').html('');

                if (rtn.comp == "media") {
                    if (!rtn.overwritten) { // only add new listing of file, if it was not overwritten
                        html = "<a>" + rtn.filename + "</a>";
                        $('#files').append(html);
                    } else {
                        $('a:contains("' + rtn.filename + '")').append(" <span class='updated icon icon-checkmark'></span>");
                        $('.updated').delay(4000).fadeOut(300);
                    }
                }

                if (rtn.comp == "content") {
                    var path = $('input[name="path"]').val();
                    scanFolder(path);
                }
            })

            .fail(function (jqXHR, textStatus) {
                $('#loader').html("Upload failed: " + textStatus).removeClass('hidden');
            });

}


$(".btnMakeDir").click(function () {
    $.ajax({url: "/admin/ajaxController.php?task=makeDir",
        dataType: "json",
        type: "POST",
        data: "path=" + $('#breadcrumbs').html() + "&folder=" + $('#inpMkFolder').val()
    })
            .done(function (rtn) {
                scanFolder(path);
            });
});

// remove folder (if empty)
$("body").on('click', ".btnDeleteFolder", function () {
    $.ajax({url: "/admin/ajaxController.php?task=delDir",
        dataType: "json",
        type: "POST",
        data: "path=" + $('#breadcrumbs').html()
    })
            .done(function (rtn) {
                $('.msg').fadeIn(50).html("Verzeichnis gelöscht").delay(5000).fadeOut('slow');
                  path = "";
                  scanFolder(path);

            });
});





$('#deleteImage').click(function () {

//    if ($('ul.files li').hasClass('selected')) {
//        $('#deleteFile').submit();
//    }

    $.ajax({url: "/admin/ajaxController.php?task=deleteFile",
        dataType: "json",
        type: "POST",
        data: "path=" + $('#breadcrumbs').html() + "&filename=" + $('input[name="filename"]').val()
                //data: "path=" + $('input[name="path"]').val()
    })
            .done(function (rtn) {
                $('.msg').html(rtn.msg).delay(5000).fadeOut('slow');

                if (rtn.deleted) {
                    $('#files .selected').remove();
                    $('input[name="filename"]').val('');
                }


            }).fail(function (jqXHR, textStatus) {
        console.log("Request failed: " + textStatus);
    });






//    var path = $('td.selected img').attr('src');
//    console.log(path);
//    
//    $('td.selected img').remove();
//     $('td.image').removeClass('selected');
//    
});













// -----------------------------------------------------------------------------
// helpers 

function isDir(n) {

    if (n.indexOf('.') == "-1") {
        return true;
    } else {
        return false;
    }

}

function isImage(n) {

    arrImgFiles = ["jpg", "JPG", "png", "PNG", "gif", "GIF"];

    var ext = getExt(n);
    //console.log("ext: " + ext);
    //console.log(n + " " + arrImgFiles.indexOf(ext));
    if (arrImgFiles.indexOf(ext) != -1) {
        return true;
    } else {
        return false;
    }


}



function getExt(n) {

    return n.split('.').pop();


}


