
var path = ''; // path excluding filename for browsing folders
var fullpath = ''; // fullpath including filename
var filename = '';

arrAllowedFiles = ["pdf", "PDF", "jpg", "JPG", "png", "PNG", "gif", "GIF"];


//const canvas = document.getElementById('canvas');
//const ctx = canvas.getContext('2d');


$('body').on('click', '.folder ', function () {
    // delete old info
    $('#files, #folders').empty();

    path = $(this).attr('data-pth');
    scanFolder(path);
});

//
//// file click
//$('body').on('click', '.file ', function () {
//    // delete old info
//    //$('#files, #folders').empty();
//    filename = $(this).html();
//    //showDrawing(filename); // old version of loading image
//    $('.file').removeClass('active');
//    $(this).addClass('loading active');
//
//    loadToCanvas(filename);
//});


// click an canvas -> show form to enter new values
//$('canvas').click(function () {
//    $('#formDrawing').removeClass('hidden');
//});


// add additional picture to canvas
//$("#inpPicture").on("change", function (e) {
//    if (e.target.files.length == 1 &&
//            e.target.files[0].type.indexOf("image/") == 0) {
////        $("#yourPic").attr("src", URL.createObjectURL(event.target.files[0]));
////
////        img = new Image();
////        img.src = URL.createObjectURL(event.target.files[0]);
////        console.log(img.src);
////        img.onload = function () {
////            ctx.drawImage(img, 0, 0);
////        }
//
//
//        var URL = window.URL;
//        var url = URL.createObjectURL(e.target.files[0]);
//        img = new Image();
//        img.src = url;
//
//        img.onload = function () {
//            ctx.drawImage(img, 120, 2800, 760, 570);
//        }
//    }
//});


// ---------------------------------------------------------
// MAIN BUTTONS

// back to start
$('.btnBack').click(function () {
    path = '';
    $('#wrapperDrawing').addClass('disabled');
    $('#formDrawing').addClass('hidden');
    resetDrawing();
    $('#files, #folders').empty();

    scanFolder();
});



$('#btnSearch').click(function () {
    $.ajax({url: "ajaxController.php?task=searchAll",
        dataType: "json",
        type: "POST",
        data: 'search=' + $('#search').val()})
            .done(function (items) {
                if (items) {
                    console.log(items);
                    $('#files, #folders').empty();
                    listItems(items);
                }


            })
            .fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });
});

// keypress event enter in input
var input = document.getElementById("search");
input.addEventListener("keyup", function (event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        $('#btnSearch').trigger('click');
    }
});








/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                  FUNCTIONS









function scanFolder(path) {
    if (!path) {
        path = '/';
    }

    $('#breadcrumbs').html(path);


    // load ref including pictures that are in ref[id] path 
    $.ajax({url: "ajaxController.php?task=scanDir",
        dataType: "json",
        type: "POST",
        data: 'path=' + path})
            .done(function (items) {

                // console.log(items);
                listItems(items);

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
                $('#folders').append("<a class='folder' data-pth='" + path + "/" + it + "'>" + it + "</a> ");
            } else {
                if (isAllowed(it)) {
                    $('#folders table').append("<tr><td><a href='/images/downloads/"+it+"' target='_blank'>" + it + "</a></td></tr> ");
                }
            }
        }
    });
}





// init
scanFolder();













// helpers 
function isDir(n) {

    if (n.indexOf('.') == "-1") {
        return true;
    } else {
        return false;
    }

}

function isAllowed(n) {

    var ext = getExt(n);
//    console.log("ext: " + ext);
    console.log(n + " " + arrAllowedFiles.indexOf(ext) + "  -  ext: " + ext);
    if (arrAllowedFiles.indexOf(ext) != -1) {
        return true;
    } else {
        console.log('not allowed ');
        return false;
    }


}



function getExt(n) {

    return n.split('.').pop();


}










// testing

function debugUpload() {

    var data = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs 9AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAxklEQVQYlYWQMW7CUBBE33yITYUUmwbOkBtEcgUlTa7COXIVV5RUkXKC5AxU EdyZVD4kyKxkwIrr9vd0c7Oih aopinLNsF6Qkg2XW4XJ7LGFsAAcTV6lF5/jLdbALA9XDAXYfthFQVx OrmqKYK88/7rbbMFksALieTnzu9wDYTj6f70PKsp2kwAiSvjXNcvkWpAfNZkzWa/5a9yT7fdoX7rrB7hYh2fXo9HdjPYQZu3MIU8bYIlW20y0RUlXG2Kpv/vfwLxhTaSQwWqwhAAAAAElFTkSuQmCC";
    $.ajax({url: "ajaxController.php?task=saveImage",
        type: "POST",
        data: {
            img: data,
            path: "testDebug.png"

        }
    })
            .done(function (rtn) {
                if (rtn) {
                    resetDrawing();
                }


            })
            .fail(function (jqXHR, textStatus) {
                console.log("Request failed: " + textStatus);
            });


}

//debugUpload();
