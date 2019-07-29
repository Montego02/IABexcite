<?php ?>
<h1>Kontaktformular</h1>

<form class="" novalidate="novalidate" action="index.php?comp=content&task=sendMail" method="post" id="webform-client-form-21" accept-charset="UTF-8">
   <fieldset class=" row-1"><div class="fieldset-wrapper">
         <div class="  -select row-1salutation">
            <label class="required" for="edit-submitted-row-1-salutation">Anrede</label>
            <select required="required" id="edit-submitted-row-1-salutation" name="title" class="hasCustomSelect">
               <option value="" selected="selected">- Auswählen -</option><option value="Frau">Frau</option><option value="Herr">Herr</option>
            </select>

         </div>
         <div class="   row-1company">
            <label for="edit-submitted-row-1-company">Firma</label>
            <input type="text" id="edit-submitted-row-1-company" name="company" value="" size="30" maxlength="128">
         </div>
      </div></fieldset>
   <fieldset class=" ">
      <div class="fieldset-wrapper"><div class="   firstname">
            <label class="required" for="edit-submitted-row-2-firstname">Vorname</label>
            <input required="required" type="text" id="firstname" name="firstname" value="" size="30" maxlength="128">
         </div>
         <div class="   lastname">
            <label class="required" for="edit-submitted-row-2-lastname">Name</label>
            <input required="required" type="text" id="lastname" name="lastname" value="" size="30" maxlength="128">
         </div>
      </div></fieldset>
   <fieldset class=""><div class="fieldset-wrapper"><div class="  street">
            <label for="edit-submitted-row-3-street">Straße</label>
            <input type="text" id="edit-submitted-row-3-street" name="street" value="" size="30" maxlength="128">
         </div>
         <div class="  streetnumber">
            <label for="edit-submitted-row-3-streetnumber">Hausnummer</label>
            <input type="text" id="edit-submitted-row-3-streetnumber" name="streetnumber" value="" size="30" maxlength="128">
         </div>
      </div></fieldset>
   <fieldset class=" row-4"><div class="fieldset-wrapper">
         <div class="   row-4zip">
            <label for="edit-submitted-row-4-zipcode">PLZ</label>
            <input type="text" id="edit-submitted-row-4-zipcode" name="zipcode" value="" size="30" maxlength="128">
         </div>
         <div class="   row-4city">
            <label for="edit-submitted-row-4-city">Ort</label>
            <input type="text" id="edit-submitted-row-4-city" name="city" value="" size="30" maxlength="128">
         </div>
         <div class="   row-4country">
            <label for="edit-submitted-row-4-country">Land</label>
            <input type="text" id="edit-submitted-row-4-country" name="country" value="" size="30" maxlength="128">
         </div>
      </div></fieldset>
   <fieldset class=" row-5"><div class="fieldset-wrapper"><div class="   row-5phonenumber">
            <label for="edit-submitted-row-5-phonenumber">Telefonnummer</label>
            <input type="text" id="edit-submitted-row-5-phonenumber" name="phonenumber" value="" size="30" maxlength="128">
         </div>
         <div class="   row-5email-address">
            <label class="required" for="edit-submitted-row-5-email-address">E-Mail Adresse</label>
            <input required="required" type="text" id="edit-submitted-row-5-email-address" name="email_address" value="" size="30" maxlength="128">
         </div>
      </div></fieldset>
   <fieldset class=" row-full"><div class="fieldset-wrapper"><div class="  -textarea row-6message">
            <label for="edit-submitted-row-6-message">Nachricht</label>
            <div class="form-textarea-wrapper resizable"><textarea id="edit-submitted-row-6-message" name="message" ></textarea></div>
         </div>
      </div></fieldset>
   <fieldset class=" row-full" >
      <div class="fieldset-wrapper"><div class="  -checkboxes row-7datenschutzbestimmung">
            <div id="boxDatenschutz" class="form-checkboxes">
               <div class=" form-type-checkbox -submitted-row-7-datenschutzbestimmung-acknowledged" style="line-height: 34px">
                  <input required="required" type="checkbox"  name="datenschutzbestimmung" value="acknowledged">  
                  <label class="datenschutz">Ich habe die <a href="/de/datenschutz">Datenschutzerklärung</a> gelesen *</label>

               </div>
            </div>
         </div>
      </div></fieldset>
   <div class="  -markup disclaimer">
      <p>*Pflichtfeld</p>

   </div>


   <div class="form-actions">
<!--      <button style="float: right; background: #999;" type="reset" class="fa form-reset" id="edit-submitted-reset-button" name="op" value="Zurücksetzen">Zurücksetzen</button>-->
      <button class="webform-submit button-primary fa form-submit" type="submit" name="op" value="Absenden">Absenden</button></div>

</form>
