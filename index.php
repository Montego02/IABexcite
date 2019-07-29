<?php
define('IAB', 'true'); // define valid entry point

require_once 'includes/init.php';
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="de">
   <head>
      <meta charset="UTF-8">
      <?php
      include 'includes/header.php';
      ?>

      <!-- styles -->
      <link rel="stylesheet" href="/images/icomoon/style.css" type="text/css">
      <link rel="stylesheet" href="/css/style.css" type="text/css">
      <link rel="stylesheet" href="/css/editor.css" type="text/css">

      <link rel="stylesheet" href="/images/icomoon/style.css" type="text/css">
      <!-- fonts -->

      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400" rel="stylesheet">

      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



      <?php
      if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)) || $_GET["mode"] == "mobile"
      ) {
          // yes, mobile
          $mobile = true;
          $_SESSION['mobile'] = true;
          $classMobile = " mobile ";
          ?>
          <link rel="stylesheet" href="css/mobile.css?v=221" type="text/css">

          <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
          <meta name="mobile-web-app-capable" content="yes">
          <meta name="apple-mobile-web-app-capable" content="yes" />
          <meta name="apple-mobile-web-app-status-bar-style" content="black" />

          <link rel="icon" sizes="192x192" href="/icon.png">


          <?php
          //include 'index_mobile.php';
      } else {
          $mobile = false;
          $_SESSION['mobile'] = false;
          $classMobile = " desktop "; // watch out: used in component veranstaltungen
      } // end else if mobile
      ?>


   </head>


   <body class="<?php echo $_SESSION['com'] . " " . $classMobile ?> <?php if ($frontpage) echo ' frontpage' ?>  <?php echo $_SESSION['baseClass'] ?>  <?php echo $_SESSION['baseId'] ?>">



      <div id="header">
         <div class="wrapper">

            <div id="languages" style="float: right">
               <a href="index.php?lang=DE" class="<?php if ($lang == "DE") echo "active" ?>" data-lang="DE">DE</a> |  <a href="index.php?lang=EN"  class="<?php if ($lang == "EN") echo "active" ?>" >EN</a> |  <a href="index.php?lang=DE"  class="<?php if ($lang == "CN") echo "active" ?>" >CN</a>
            </div>

            <div id="boxLogo" class="floater">
               <a href="/">
                  <img id="logo" src="/images/logo.png" title="" />
               </a>
            </div>

            <nav id="mainmenu" class="clear">
                <?php include 'modules/menu/' . $lang . ".php" ?>
            </nav>




         </div>


         <div id="redLine"></div>

      </div>

      <?php if (!$frontpage) { ?>
          <div id="baoCopy"><img style="width: 300px" src="/images/baoCopy.png" /></div>
      <?php } ?>





      <div class="wrapper">


<!--         <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 50" style="margin-top: 30px; width: 800px; height: 400px">
         <defs>
         <clipPath id="clip"  clipPathUnits="userSpaceOnUse">
            <polygon points="10,0 40,0 50,10 60,0 100,0 100,100 60,100 50,90 40,100 10,100 0,90 0,10"  />
            <circle cx="50" cy="50" r="50"/>

         </clipPath>
         </defs>


         <image height="100%" preserveAspectRatio="xMinYMin slice" width="100%" 
                xlink:href="https://internet-agentur-bodensee.com/intern/previews/wisco/images/bg/bg3.jpg" 
                clip-path="url(#clip)" />

         </svg>-->


         <?php if ($frontpage) { ?>
             <div  id="claim" >
                <h3>Willkommen bei<br>Baosteel Lasertechnik</h3>
                Ihr innovativer Sondermaschinenbauer
             </div>
         <?php } ?>


         <?php
         if ($frontpage) {
             ?>
             <div class=" boxHighlights" style="">
                 <?php include 'modules/frontpage/' . $lang . ".php" ?>
             </div>
             <?php
         }
         ?>

      </div>  





      <div id="wrapperContent">
         <div class="wrapper  flexbox">
             <?php if (!$frontpage && $baseId) { ?>
                <div id="sidemenu" >

                   <?php helper::getSubMenu($baseId); ?>

                </div>
            <?php } ?>

            <?php
            if ($msg) {
                ?>
                <div class="box msg">
                    <?php echo $msg ?>
                </div>
                <?php
            }
            ?>

            <div class="content">


               <?php print_r($_SESSION['html']) ?>

               <?php
               // echo $_SESSION['dbg'];
               ?>

            </div>
         </div> 
      </div>
      <!-- content end -->


      <div id="footer" class="clearfix">

         <div class="wrapper">
            &copy; <?php echo date('Y') ?> by Baosteel Lasertechnik GmbH &middot;
            <a href="141-impressum" >Impressum</a>
         </div>
      </div>





      <!-- END WRAPPER -->

      <div id="popupLogin" class="hidden">

      </div> 






      <script src="js.js" ></script>


