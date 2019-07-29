
// UPLOAD IMAGE

$('#image').change(function (e) {
    e.preventDefault();
    if ($('#image').val()) {
        uploadImage();
    } else {
        alert ('Bitte wählen Sie zunächst ein Bild aus.');
    }
    
});

function uploadImage() {
    var file_data = $('#image').prop('files')[0];
    var form_data = new FormData($('form')[0]);
    form_data.append('image', file_data);

    $('.previewImage').html('<img src="/images/ajax-loader.gif">'); // show loader

    // 2 save image
    $.ajax({url: "ajaxController.php?task=saveAppImage",
        dataType: "json",
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        enctype: 'multipart/form-data',
        data: form_data
    })

            .done(function (rtn) {
                console.log(rtn);
                $('#previewImage').html('<img class="previewImage" src="/images/apps/' + rtn.filename + '" >');
                $('input[name="imageUploadName"]').val(rtn.filename);

            })

            .fail(function (jqXHR, textStatus) {
                $('#previewImage').html("Upload failed: " + textStatus).removeClass('hidden');
            });

}