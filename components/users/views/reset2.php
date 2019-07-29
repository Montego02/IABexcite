<h2>Passwort zurücksetzen</h2>
<h3>Schritt 2: Neues Passwort eingeben</h3>

<form id="reset2" action="index.php?com=users&task=resetPass3" method="post">
<input name="pass1" class="huge" placeholder="Neues Passwort"> <br>
<input name="pass2" class="huge" placeholder="Passwort wiederholen"> <br>
<input type="hidden" name="token" value="<?php echo $_GET['activation'] ?>">

<button id="btnSubmitReset2">Passwort neu setzen</button>

</form>