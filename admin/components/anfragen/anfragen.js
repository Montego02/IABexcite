// load history/actions of anfrage
$.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=loadActions",
    type: "POST",
    dataType: "json",
    data: {id: $('#id').val()}
}).done(function (items) {
    console.log('done');
    console.log(items);
    $.each(items, function (i, item) {
        var html = "<tr><td>" + item.date + "</td><td>" + item.text + "</td></tr>";
        $('#tblHistory').append(html);
    });
});


// load ents who bought someting
$.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=loadZahlungen",
    type: "POST",
    dataType: "json",
    data: {id: $('#id').val()}
}).done(function (items) {
    console.log('done');
    console.log(items);
    $.each(items, function (i, item) {
        var html = "<tr><td><a target='_blank' href='index.php?comp=verzeichnis&view=detail&ownerid=" + item.userid + "'>" + item.userid + "</a></td><td>" + item.status + "</td></tr>";
        $('#zahlungen').append(html);
    });
});


// load fragen/antworten
$.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=loadFragen",
    type: "POST",
    dataType: "json",
    data: {id: $('#id').val()}
}).done(function (items) {

    console.log(items);
    $.each(items, function (i, item) {
        console.log(item.antwort)
        var cl = (item.antwort == null) ? "red" : "";
        var subject = "Frage zur Ihrer Ausschreibung im App Entwickler Verzeichnis";
        var body = "Sehr geehrte Damen und Herren,\n\n Ein Programmierer hat eine Frage zu Ihrer Anfrage im App Entwickler Verzeichnis:\n"
                + "----------------------------------------------------------------\n "
                + item.frage + "\n"
                + "----------------------------------------------------------------\n "
                + "Bitte antworten Sie mir auf diese E-Mail so bald als möglich!\n\n";
        var html = "<a target='_blank' href='index.php?comp=users&view=detail&id=" + item.userid + "'>UserId " + item.userid + ": </a>"
                + "<textarea class='frage frage" + item.id + " " + cl + "' >" + item.frage + "</textarea>"


                + "<textarea class='answer answer" + item.id + "' placeholder='Antworttext'>";
        if (item.antwort != null) {
            html += item.antwort;
        }
        html += "</textarea>"

                + "<a class='btn small saveAnswer ' style='float: right' data-id='" + item.id + "'><i class='icon-floppy-disk'></i> speichern</a>"

                + " <a class='btn small' style='margin:0;  float: left' href='mailto:"
                + encodeURI($('#email').val() + "?subject=" + subject + "&body=" + body) + "'>Mail Anfrager</a>"

                + "<hr/>";
        $('#fragen').append(html);
    });
});



// save  question & Answer
$('body').on('click', '.saveAnswer', function (e) {
    e.preventDefault();
    var btn = $(this);
    var id = $(this).attr('data-id');
    $.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=saveAnswer",
        type: "POST",
        data: {id: id,
            ans: $('.answer' + id).val(),
            frage: $('.frage' + id).val()
        }
    }).done(function (rtn) {
        if (rtn) {
            if (rtn == 'deleted') {
                $('.answer' + id).remove();
                $('.frage' + id).remove();
                $(btn).html('deleted').prop("disabled", true);
            } else {
                $(btn).html('saved').prop("disabled", true);
            }

        }
    });
});


$('#sendMessage').click(function () {

    $.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=sendMessage",
        type: "POST",
        data: {message: $('#message').val(),
            email: $('#email').val(),
            name: $('#anrede').val() + " " + $('#name').val(),
            titel: $('#titel').val()
        }
    })
            .done(function (rtn) {
                $('#sendMessage').html('versendet').prop("disabled", true);
                saveAction("msg: " + $('#message').val());
            })

            .fail(function (rtn) {
                console.log('fail');
            });
});
function saveAction(text) {
    if ($('#id').val()) {

        $.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=saveAction",
            type: "POST",
            data: {anfrage: $('#id').val(),
                text: text
            }
        })
                .done(function (rtn) {

                })

                .fail(function (rtn) {
                    console.log('fail');
                });
    } else {
        alert('Neue Anfragen müssen zunächst gespeichert werden.');
    }

}



$('#btnCreateProject').click(function () {
    $.ajax({url: "/admin/components/anfragen/ajaxControllerAnfragen.php?task=createProject",
        type: "POST",
        data: {anfrage: $('#id').val()}
    })
            .done(function (rtn) {
                if (rtn) {
                    $('#btnCreateProject').html('Projekt angelegt').prop('disabled', true);
                }
            });
})
        ;

