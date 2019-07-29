
var basePath = "";


// highlight file
$('body').on("click", ".file", function () {
    $('.updated').remove(); // remove "updated" span first
    $('#files a').removeClass('selected');
    $(this).addClass('selected');


    var filename = $(this).html().replace(/\s/g, "");
    var path = $('input[name="path"]').val();

    console.log("filename: " + filename);
    console.log("path: " + path);
    $('input[name="filename"]').val(filename);
    $('#breadcrumbs').val(path + filename);


});



// init media
$('document').ready(function () {
    scanFolder();

});
