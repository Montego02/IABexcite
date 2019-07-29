$('#btnSendActivatedMessage').click(function () {


    $.ajax({url: "/admin/components/verzeichnis/ajaxControllerVerzeichnis.php?task=sendActivatedMessage",
        type: "POST",
        data: {
            message: 'aktiviert', // bräuchten wir nicht mehr - gibt nur noch aktiviert...
            email: $('#email').val(),
            person: $('input[name="person"]').val(),
            confirm: $('input[name="confirm"]').val()
        }
    })
            .done(function (rtn) {

                $('#btnSendActivatedMessage').html('Mail gesendet').prop("disabled", true);

            })

            .fail(function (rtn) {
                console.log('fail');
            });
});


$('#btnGenerateInvoice').click(function (e) {
    e.preventDefault();
    $.ajax({url: "/admin/components/verzeichnis/ajaxControllerVerzeichnis.php?task=generateInvoice",
        type: "POST",
        data: {form: $('#frmInvoice').serialize()}
    })
            .done(function (rtn) {
                console.log(rtn);
                $('#btnGenerateInvoice').html(' - generiert - ').prop("disabled", true);



            })

            .fail(function (rtn) {
                console.log('fail');
            });
});
$('.bookPremiumPayment').click(function (e) {
    var btn = $(this);
    e.preventDefault();
    $.ajax({url: "/admin/components/verzeichnis/ajaxControllerVerzeichnis.php?task=bookPremiumPayment",
        type: "POST",
        data: {id: $(this).attr('data-id')}
    })
            .done(function (rtn) {
                $(btn).html(' - generiert - ').prop("disabled", true);
            })

            .fail(function (rtn) {
                console.log('fail');
            });
});
$.ajax({url: "/admin/components/verzeichnis/ajaxControllerVerzeichnis.php?task=getStornoQuota",
    type: "POST",
    dataType: 'json',
    data: {id: $('input[name="owner"]').val()}
})
        .done(function (rtn) {
            console.log(rtn);
            var html = "";
            var sumGood = 0;
            var sumStorno = 0;
            $.each(rtn, function (i, it) {
                if (it.status == "Completed" || it.status == "credits")
                    sumGood += parseInt(it.sum);
                if (it.status == "storniert")
                    sumStorno += parseInt(it.sum);
            });
            var total = parseInt(sumGood) + parseInt(sumStorno);
            var quota = Math.round(sumGood / (total) * 100);
            $('#stornoQuota h2').html(quota + "%");
            $('#stornoQuota div').html("Gekauft gesamt: " + total + "<br>Storniert: " + sumStorno);
        })

        .fail(function (rtn) {
            console.log('fail');
        });