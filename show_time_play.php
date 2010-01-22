<?php

   include 'default.php';

   session_name('RT_kontext');
   session_start();
   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");


   /**
    *
    */
   function showTime() {
   $file = $files["connect"];
   require_once ("$file");
      $navrat=mysql_query("SELECT * FROM `ODEHRANY_CAS`;");
      // do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
      while( list($id, $od, $do_c, $player, $match) = mysql_fetch_row($navrat) )
      {
         echo $id.$od.$do_c.$player.$match."<br>";
      }
   }
   
   showTime();

?>