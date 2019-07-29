



<?php
$user = $_SESSION['user'];


if (!$user) {

    if ($_SESSION['mobile']) {
        // show login for mobile users (because its missing in head
        ?>
        <h2>Login</h2>
        <div class="mobPad">
            <?php
            include'includes/forms/login.php';
            ?>
           <a href="/index.php?com=users&amp;view=reset1" class=" small">Passwort vergessen?</a>
        </div>
     
        <?php
    }
    ?> 








    <div class="box2 boxleft">
       <h2 style="text-align: left">Registrierung bei <?php echo SITE ?></h2>
       <form id="formRegister" class="icoForm " action="index.php?com=users&task=doRegister" method="POST" >

          <div>
             <label for="username" class="icon-user"></label>
             <input name="username"  placeholder="Benutzername" autocomplete="name"  class="required"  >
          </div>
          <div>
             <label for="password" class="icon-lock"></label>
             <input type="password" name="password"  placeholder="Passwort" class="required" >
          </div>
          <div> 
             <label for="email" class="icon-envelop"></label>
             <input type="email" name="email" placeholder="E-Mail"  class="required" value="<?php echo $_SESSION['form']['email'] ?>">
          </div>

          <div>
             <label for="email" class="icon-command"></label>
             <input  name="code" id="codesix" placeholder="captcha" value="" class="required" style="width: 120px">
             <img alt="" src="/images/icons/codesix.gif" style="float: right; margin: 2px 20% 0 0">
          </div>

          <div>
<!--             <input type="checkbox" class="required scale2" name="agb" value=""> Ich stimme den <a href="/agb" target="_blank">AGB</a> zu<br>-->
             <input type="checkbox" class="required scale2" name="ds" value=""> Ich habe die <a href="/intern/datenschutzerklaerung" target="_blank">Datenschutzerklärung</a> erhalten<br>
          </div>


          <button id="btnRegister" type="submit">Registrieren</button>

       </form>




       <!--    
           <div class=" box4 hidden" id="showReset">
               <h2>Passwort zurücksetzen</h2>
                 <form class="icoForm" action="index.php?com=users&task=resetPass" method="POST" autocomplete="off" >
                    fake fields are a workaround for chrome autofill getting the wrong fields 
                   <input style="display:none" type="text" />
                   <input style="display:none" type="password" />
                     
                     
               <div>
                   <label for="usr" class="icon-user"></label>
                   <input name="usr" id="usr" placeholder="Benutzername" value="" autocomplete="name">
               </div>
                     <div>
                   <label for="email" class="icon-envelop"></label>
                   <input type="email" name="email"  placeholder="verwendete E-Mail" value="" autocomplete="email">
               </div>
               <div>
                   <label for="pass" class="icon-lock"></label>
                   <input type="password" name="pass" placeholder="NEUES Passwort" value="">
               </div>
                
       
               <button type="submit">Passwort ändern</button>
       
           </form>
           </div>-->



    </div>




    <div class="boxright box2">
       <h2>Keine Verpflichtung - viele Möglichkeiten</h2>

       <ul class="plus">
          <li>Favoriten anlegen</li>
          <li>Inhalte individualisieren</li>
          <li>Freunde gewinnen</li>
          <li>Fragen stellen</li>                        
          <li>Tagebuch führen</li>
          <li>Spamfrei!</li>
       </ul>
       <p><b>Durch die Registrierung entstehen keinerlei Kosten oder Verpflichtungen.</b></p>
    </div>



    <!--<h1>Login</h1>-->

    <?php
    // login per ajax geht hier nicht, da sonst zwei formulare mit identischen 
    // include'includes/forms/login.php' 
    ?>

<?php } else { ?>

    <h1>Login</h1>
    <p>Sie sind angemeldet als <b><?php echo $user->username ?></b> </p><br>
    <a class="btn" href="index.php?task=logout" id="btnLogout">logout</a>


<?php } ?>


<script>

    $('#btnRegister').click(function (e) {
        e.preventDefault();
        var validated = true;
        $('.required').each(function (index) {
            if ($(this).is(':checked')) {
                $(this).removeClass('invalid');
            } else {
                if (!$(this).val()) {
                    validated = false;
                    $(this).addClass('invalid');
                } else {
                    $(this).removeClass('invalid');
                }
            }

        });
        if ($('#codesix').val() != '6482') {
            $('#codesix').addClass('invalid');
            validated = false;
            alert('Bitte geben Sie den Sicherheitscode (korrekt) ein.');
        }


        if (validated) {
            console.log('sumitting');
            $('#formRegister').submit();
        } else {
            window.scrollTo(0, 300);
        }


    });

</script>
