






<!--login component-->
<div class="box2 boxleft" style="width: 400px">
    <h2>Service-Login</h2>
    <div  class=" <?php if (!$user) echo "hidden"; ?>  ">
      
        <a class="btn" href="index.php?task=logout" id="btnLogout" >logout</a>
    </div>

    <div class="login <?php if ($user) echo "hidden"; ?> ">
        <form class="icoForm" action="index.php?com=users&task=doLogin" class="icoForm" method="post">
            <div>
                <label for="username" class="icon-user"></label>
                <input type="text" name="username"  placeholder="Benutzername">
            </div>
            <div>
                <label for="password" class="icon-lock"></label>
                <input type="password" name="password" id="password" placeholder="Passwort">
            </div>

            <button type="submit">Login</button>

            <br>
            <a href="/index.php?com=users&amp;view=reset1" class=" small">Passwort vergessen?</a>
        </form>
    </div>




</div>


<!--
<div class="fbLogin boxright">
    <h2>Login mit Facebook</h2>
    <div class="boxFbLogin">
        <p class="small">- UNFINISHED BETA -</p>
        <fb:login-button 
            scope="public_profile,email"
            onlogin="checkLoginState();">
        </fb:login-button>
    </div>

    <div class="boxFbWelcome">


    </div>

</div>
-->