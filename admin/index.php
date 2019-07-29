<?php
define('IAB', 'true'); // define valid entry point
require_once 'includes/init.php';
?>


<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <title><?php echo SITE ?> Backend</title>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!--        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <!-- styles -->
      <link rel="stylesheet" href="images/icomoon/style.css" type="text/css">
      <link rel="stylesheet" href="template.css" type="text/css">
      <link rel="stylesheet" href="style_admin.css" type="text/css">
      <link rel="stylesheet" href="/css/editor.css" type="text/css">

      <!-- datepicker -->
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

      <!-- HTML editor -->
      <!--        <link type="text/css" rel="stylesheet" href="js/jQueryTE/jquery-te-1.4.0.css">-->

      <script src="js/trumbo/dist/trumbowyg.js"></script>
      <link rel="stylesheet" href="js/trumbo/dist/ui/trumbowyg.css">



      <!-- fonts -->
      <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>


   </head>  
   <body class='<?php echo $_GET['comp'] ?>'>

      <div id="wrapper">
         <div id="header" class="clear">
            <a id="goToSite" href="<?php echo URL ?>" target="_blank" class="icon-earth light biggest" style="float:right;" title="Zur Website"></a>

            <h1 class="toptitle"><?php echo SITE ?> Backend</h1>
         </div>
         <div id="menu" >

           

            <a href="index.php?task=logout" class="lens" id="btnLogout">logout</a>

            <ul  class="horizontal tabmenu clear" >
               <li><a href="index.php" class="active"><span class="icon-home3"></span></a></li>
               <li><a href="index.php?comp=users" class="users"><span class="icon-user"></span>Benutzer</a></li>
               <li><a href="index.php?comp=media&view=folder&folder=/images" class="media"><span class="icon-images"></span>Medien</a></li>
               <li><a href="index.php?comp=content" class="content"><span class="icon-book"></span>Content</a></li>
         
            </ul>
         </div>

         <div id="inner">


            <div id="main"  class="page    <?php echo $_GET['comp'] ?>  <?php echo $_GET['view'] ?>">
                <?php
                // REMOVE task == save -  its only for PRE REGISTER PHASE
                if ($user->level >= 3 || $_SESSION['logged'] || $task == "save") {
                    $comp = $_GET['comp'];
                    if (!empty($comp)) {
                        require_once 'components/' . $comp . '/model.php';
                        require_once 'components/' . $comp . '/controller.php';
                        $compController = new compController(); // instantiate COMPONENTS controller
                    } else {
                        // no comp => dashboard
                        include 'includes/pages/start.php';
                    }
                } else {
                    include 'components/users/views/login.php';
                }
                ?>
            </div>




         </div>


         <div id="debug" class="hidden">
            <pre>
DEBUG
               <?php
//var_dump($user);
               ?>
            </pre>      
         </div>

      </div>



      <!-- scripts we need after dom load -->
      <script src="js/handlers.js" type="text/javascript"></script>
      <script src="js/media.js" type="text/javascript"></script>



   </body>









</html>










