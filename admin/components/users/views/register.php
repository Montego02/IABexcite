<h2>Neuen User anlegen</h2>

<p>Diese Funktion steht nur bis zum 06. Mai zur Verfügung.</p>

<div id='msgContainer'>
    
</div>

<form id="registerForm" action="index.php?comp=users&task=save" method="POST" >
    <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" >

<table class="detail">
              
    <tr><th>Benutzername</th> <td><input name="name" value="<?php echo $item->name ?>" placeholder="Benutzername" ></td></tr>
    <tr><th>Passwort</th> <td><input name="password" value="" placeholder="mindestens 6 Zeichen" ></a></td></tr>
    <tr><th>E-Mail</th><td><input name="email" value="<?php echo $item->email ?>" placeholder="E-Mail" > </td></tr>
 
   
</table>   

    <input type='hidden' name="status" value="1" >
    <input type='hidden' name="level" value="2" >
    <br >
       <button id='btnRegister' class='ajax'>Registrieren</button>
    
</form>

<script src="ajax.js"></script>

