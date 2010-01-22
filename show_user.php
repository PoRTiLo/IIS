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
   function showUser() {
      $file = $files["connect"];
      require_once ("$file");
      $navrat=mysql_query("SELECT * FROM `USER`;");
      // do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
      while( list($login, $pass, $name, $surname, $email, $pozicion) = mysql_fetch_row($navrat) )
      {
         echo $login.$pass. $name.$surname. $email.$pozicion."<br>";
      }
   }

   
   showUser();

?>
