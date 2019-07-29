
<?php
$folder = $_GET['folder'];
$path = ".." . $folder . "/";

$items = scandir($path);
$blacklist = array('.', '..', '.htaccess', 'admin', 'components', 'css', 'includes', 'js', 'xml', 'docu');
$blacklistExt = array('php')
?>

<div id="tasks">
   <a id="deleteImage" title="Löschen" class="icon-bin"></a>
</div>
<h2><span class="icon-images"></span><a href="index.php?comp=media">Medien</a></h2>

<!--<b>Pfad</b> <input name="visiblepath" value="<?php echo $folder ?>" style="width: 500px; margin-bottom: 15px" >-->



<!--hidden form fields for ajax-->
<input  type='hidden' name='path' value='<?php echo $path ?>' >
<input type='hidden' name='filename' value='' >



<div class='msg hidden '></div>


<div class="flexbox" style='padding-top: 20px'>



   <div class="" style="flex: 2; margin-right: 20px">

      <div id="navButtons" class="clear">
         <button class="btnBack"><i class="icon icon-first"></i></button>
      <!--               <input id="search" placeholder="suche, z.B. 'air'">
         <button id="btnSearch"><i class="icon icon-play3"></i></button> -->

         <div id="breadcrumbs">/</div>
         <input type="hidden" name="path">
      </div>

      <ul id="folders">
      </ul>



      <div id='files'>
      </div>
   </div>



   <div style="flex: 1">

      <div class=" box2 " >
         <h4><i class='icon-upload'></i> Datei Upload</h4>
         <div id="loader"></div>
         <form id="formDetail">
            <input type="file" id="image" placeholder="Datei auswählen " style="margin: 10px 0">  
            <input type="hidden" name="comp" value="media"> <!-- for ajax forms / image upload -->
            <input type="hidden" name="folder" value="<?php echo $path ?>"> <!-- for ajax forms / image upload -->
            <a id="uploadImage" class="btnSmall">Datei hochladen</a>
         </form>
      </div>


      <div class='box2' style='margin-top: 10px'>
         <h4><i class='icon-folder-plus '></i>  Verzeichnis anlegen</h4>

         <div style='display: block'>
            
            <input id='inpMkFolder' name='inpMkFolder' placeholder="Foldername" style='width: 180px' >
              <a class='btn btnMakeDir'>anlegen</a>
         </div>
       
       
      </div>

   </div>





</div>   


<script src="components/media/assets/handlersMedia.js"></script>