



<?php
if ($item->id) {
    ?>
    <h2><span class="icon-book"></span>Content ID <?php echo $item->id ?></h2>
<?php } else { ?>
    <h2><span class="icon-book"></span>Neuen Content anlegen</h2>
<?php } ?>

<?php
$lnkForm = "index.php?comp=" . $_GET['comp'] . "&task=";
?>







<form id="formDetail" action="<?php echo $lnkForm ?>" method="POST" >
   <input type="hidden" name="id" id="id" value="<?php echo $item->id ?>" >

   <?php echo layoutHelper::detailButtons(); ?>


   <div id="rightcol">

      <div class="box">
         <h3>Veröffentlichung</h3>
         <input type="hidden" name="state" value="0">
         <label class="switch">       
            <input type="checkbox" name="state" value="1" <?php if ($item->state == 1) echo " checked " ?>>
            <span class="slider round"></span>
         </label>
      </div>


      <div class="box">
         <h3>Reihenfolge</h3>
         <input name="ordering" class="" style=" " value="<?php echo $item->ordering ?>" >
      </div>


      <!--      <div class="box">
               <h3>Meta Daten</h3>
               <input name="metakey" class="" style=" " value="<?php echo $item->metakey ?>" >
               <input name="metadesc" class="" style=" " value="<?php echo $item->metadesc ?>" >
            </div>-->

      <div class="box">
         <h3>Sprache</h3>
         <select name="lang">
             <?php
             $lang = ["DE", "EN"];
             layoutHelper::ddWithValue($lang, $item->lang, "DE")
             ?>
         </select>


      </div>


      <div class='box  '>
         <h3>Medien einfügen</h3>
         <div id="navButtons" class="clear">
            <button class="btnBack"><i class="icon icon-first"></i></button>
<!--               <input id="search" placeholder="suche, z.B. 'air'">
            <button id="btnSearch"><i class="icon icon-play3"></i></button> -->

            <div id='breadcrumbs'></div>
            <input type='hidden' name='path' />

         </div>


         <div id='folders' class='clear'></div>
         <div id='files' class='clear' ></div>
         <div id='previewPic' class="border clear"></div>
         <div id="settingsPic" class="hidden">
            <table class="border lined" style="margin: 10px 0">
               <tr>
                  <th>Ausrichtung</th><td><i class="icon-align-left active" data-class='floatLeft'></i> <i class="icon-align-right"  data-class='floatRight'></i></td>
               </tr>
               <tr>
                  <th>Größe
                     <p class="small">(Breite)</p>
                  </th>
                  <td class="small">
                     <input type="radio" name="imgSize" class="imgSize" value="1" data-size='200px' checked> klein (200px)<br>
                     <input type="radio" name="imgSize"  class="imgSize" value="2"  data-size='500px' > mittel (500px)
                     <input type="radio" name="imgSize"  class="imgSize" value="2"  data-size='100%' > groß (100%)

                  </td>
               </tr>

            </table>
            <button class='btnInsertImage'>Einfügen</button>

         </div>

      </div>





      <div class='box  '>
         <h3>Medien hochladen</h3>

         <button id='uploadImage' style='float: right; width: 20%; height: 28px; text-align: center'><i class='icon icon-upload'></i></button>
         <input id='image' type="file" style='display: inline-block; width: 75%' placeholder="Bild hochladen">


      </div>


   </div>


   <table class="detail" > 
      <tr><th class="big">Titel</th> 
         <td><input name="title" class="bigger" style=" " value="<?php echo $item->title ?>" ></td>
      </tr>

      <tr><th class="big" title="Wie wird dieser Beitrag im Menu genannt">Menu Titel </th> 
         <td><input name="menuTitel" class="bigger" style=" " value="<?php echo $item->menuTitel ?>" ></td>
      </tr>



      <tr ><th >Rolle</th> 
         <td>
            <select name="role">
               <option value="2" <?php if ($item->role == 2) echo " selected " ?>>Artikel</option>
               <option value="1" <?php if ($item->role == 1) echo " selected " ?>>Kategorie / Hauptmenu</option>

            </select>
            <i class="icon icon-info" title="Kategorien sind Container (Eltern) für Beiträge und zeigen diese in einer Blogansicht"></i>


         </td>
      </tr>

      <tr ><th >Eltern</th> 
         <td>
             <?php
             $articles = mh::getAricleTitles();
             ?>
            <select name="parent">
               <option> - top - </option>
               <?php layoutHelper::ddWithKey($articles, $item->parent) ?>
            </select>

         </td>
      </tr>


      <tr><th class="big">Introtext</th> 
         <td>
            <textarea name="introtext"  class='editable' style='  height: 250px'  ><?php echo $item->introtext ?></textarea>
         </td>
      </tr>


      <tr><th class="big">Fulltext</th> 
         <td>
            <textarea name="fulltext" class='editable' style='  height: 500px'  ><?php echo $item->fulltext ?></textarea>
         </td>
      </tr>


    <!--        <tr><th class="big">Elternkategorie</th> 
        <td>
            <select name="parent" >
                <option value='0'>- keine -</option>
      <?php // echo mh::getProduktkategorienAsDD($item->parent, true)     ?>
            </select>
        </td>
    </tr>-->





<!--      <tr><th class="">Sprache</th> 
         <td>
            <select name="lang" >
               <option <?php if ($item->lang == "DE") echo " selected " ?> >DE</option>
               <option <?php if ($item->lang == "EN") echo " selected " ?> >EN</option>

            </select>
         </td>
      </tr>-->

<!--      <tr><th class="">Reihenfolge</th> 
         <td><input name="ordering" class="numeric" style="width: 40px" value="<?php echo $item->ordering ?>" ></td>
      </tr>-->


<!--      <tr><th class="">Öffentlich ab</th> 
         <td><input name="publish_up" class="date datepicker" value="<?php echo $item->publish_up ?>" >
            <span class="small"> Wenn Sie hier ein Datum einfügen, wird der Beitrag erst <b>ab</b> diesem Datum angezeigt.
            </span>
         </td>
      </tr>-->

      <tr><th class="">Modified</th> 
         <td><input name="modified" class="date datepicker disabled" value="<?php echo $item->modified ?>" >
         </td>
      </tr>


      <tr><th class="">Erstellt am</th> 
         <td><input name="created" class="date datepicker disabled" value="<?php echo $item->created ?>" ></td>
      </tr>

<!--      <tr><th class="">Bild Link</th> 
         <td>  <input type="" name="images" value="<?php echo $item->images ?>" /></td>
      </tr>-->



   </table>   


   <input type="hidden" name="comp" value="content" />



</form>




<script type="text/javascript" src="js/jQueryTE/jquery-te-1.4.0.min.js" charset="utf-8"></script>


<script>

    // check if article contains DIV - if so dont activate editor because it replaced div with p

    var intro = $('[name="introtext"]').val();
    var fulltext = $('[name="fulltext"]').val();

    if (intro.includes('<div') || intro.includes('<div')) {
        console.log('text has DIV - Editor disabled');
    } else {

        $('.editable').trumbowyg({
            imageWidthModalEdit: true
        }); //.jqte();


        // settings of status
        var jqteStatus = true;
        $(".status").click(function ()
        {
            jqteStatus = jqteStatus ? false : true;
            $('.jqte-test').jqte({"status": jqteStatus})
        });
    }

</script>


<script>



    var cat = "<?php echo $item->catid ?>";
    var basePath = "content"; // path for media module

// init media
    $('document').ready(function () {

        scanFolder(basePath);
    });

</script>
<script src="components/content/assets/handler.js"></script>
<script src="js/trumbo/dist/IABpluginImage.js"></script>
