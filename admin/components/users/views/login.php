<?php ?>
<h2>Login</h2>

<?php
if ($_SESSION['msg']) {
    ?>
    <div class="msg">
        <?php echo $_SESSION['msg']; ?>
    </div>
    <?php
    unset($_SESSION['msg']);
}
?>

<div id="login">

    <form action="index.php?task=login" id="login" method="post">
        <div >
            <label for="username" class="icon-user" ></label>
            <input name="username" id="username" placeholder="Benutzername">
        </div>
        <div>
            <label for="password" class="icon-lock"></label>
            <input type="password" name="password" id="password" placeholder="Passwort">
        </div>

        <button type="submit">Anmelden</button>
    </form>
</div>    

<hr>

<div id='register'>
    <?php // include 'components/users/views/register.php'; ?>
</div>


<?php
if ($_SESSION['loginFailed']) {
    ?>
    <script>
        $("#login").effect("shake");
    </script>
    <?php
    unset($_SESSION['loginFailed']);
}
?>