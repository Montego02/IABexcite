<?php ?>

<style>

   #search, #navButtons button {
       display: inline-block;
       margin-top: 0;
       float: left;
   }

   #search {
       box-sizing: border-box;
       height: 40px;
       padding: 6px;
       font-size: 22px; width: 250px;

   }

   .box {
       box-sizing: border-box;
       width: 100%
   }


   #breadcrumbs {
       padding: 3px 20px; 
       background: #ddd; color: #777;
       height: 17px;
       font-size: 12px;
       margin: 5px 0
   }


   .folder, .file {
       background: #000080; color: white;
       padding: 5px 10px; 
       margin: 3px;
       cursor: pointer;
       border-radius: 3px
   }

   .folder {font-size: 120%}

   .file {background: #e5e5e5;
          border: 1px solid #261868;
          color: #666
   }


   #navButtons button {
       height: 40px;
       line-height: 40px;
       font-size: 26px;
       margin: 0 10px;
   }


</style>

<h2>Downloads</h2>

<div class="wrapper">
   <div id="navButtons" class="clear">
      <button class="btnBack"><i class="icon icon-first"></i></button>
      <input id="search" placeholder="suche" />
      <button id="btnSearch"><i class="icon icon-play3"></i></button>
   </div>

   <br><br>
   <!--   <div id="breadcrumbs">/</div>-->

   <div id="folders" class="box">
      <table class="striped">      </table>
   </div>
</div>



<script src="/js/downloads.js" ></script>
