<?php
session_start();


//session::cleanup();

if ($_SESSION['time']) {
    $user = $_SESSION['user'];

    $sessionAge = time() - $_SESSION['time']; // age in seconds
// check if session is fresh enough or reset if not
    if ($sessionAge > (SESSIONAGEMAX * 60)) {
        session_unset();
        $_SESSION['msg'] = "Ihre Sitzung ist abgelaufen. Bitte melden Sie sich erneut an.";
        //header('location: /index.php');
    } else {
        $_SESSION['time'] = time(); // refresh time on interaction
    }
}

class session {
    // unused so far
    public static function showMessage() {
        if ($_SESSION['msg']) {
            ?>
            <div class="msg">
                <i class="icon big floatleft <?php echo $_SESSION['msgIcon'] ?>"></i>
                <?php echo $_SESSION['msg'] ?>
            </div>
            <?php
            // clear messages
            unset($_SESSION['msg']);
            unset($_SESSION['msgIcon']);
            unset($_SESSION['msg']);
        }
    }

    public static function cleanup() {
        unset($_SESSION['title']);
        unset($_SESSION['desc']);
        unset($_SESSION['option']);
        unset($_SESSION['com']);
        unset($_SESSION['view']);
        unset($_SESSION['id']);
        unset($_SESSION['form']);
        unset($_SESSION['html']);
      //  we clear those directly after displaying message so we can forward by header without losing messages        
      //  unset($_SESSION['msg']);    
      //  unset($_SESSION['msgIcon']);
      //  unset($_SESSION['msgType']);
        unset($_SESSION['limit']); // limits number of db results
        unset($_SESSION['debug']);
        unset($_SESSION['frontpage']);
        unset($_SESSION['layout']);
        unset($_SESSION['page']);
        
        //unset($_SESSION['mobile']);  is always set to either true or false -> show not be reset
        
    }

}
