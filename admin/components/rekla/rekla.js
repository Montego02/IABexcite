 function doIt(id, newStatus, zahlungsId, erstattungsweise, credits, user, titel, email) {
     console.log(newStatus);
        var id = id;
        var newStatus = newStatus;
        var zahlungsId = zahlungsId;
        var erstattungsweise = erstattungsweise;
        var credits = credits;
        var credits = credits; // wird nur bei Rückbuchung per Credits übergeben
        var user = user; // für messaging und creditsübergabe
        var jetzt = new Date();
        var datum = jetzt.getFullYear() + "-" + jetzt.getMonth() + 1 + "-" + jetzt.getDate();
        var titel = titel;

        document.getElementById('id').value = id;
        $('#status').val(newStatus);
        document.getElementById('zahlungsId').value = zahlungsId;
        document.getElementById('credits').value = credits;
        document.getElementById('user').value = user;
        document.getElementById('titel').value = titel;
        document.getElementById('email').value = email;
        document.getElementById('actions').value = datum + " " + erstattungsweise + " " + newStatus;

        if (newStatus == "deleted" && document.getElementById('message').value == "- keine -") {
            alert("Es wurde kein Ablehnungsgrund gewählt. Die Reklamation kann daher nicht gelöscht werden")
        } else {
            
           // console.log($('#frmSolve'));
           $('#frmSolve').submit();
           
        }
//alert (document.getElementById('credits').value);	
    }