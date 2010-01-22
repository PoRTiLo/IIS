<?php

   include 'default.php';

   session_name('RT_kontext');
   session_start();
   require_once('head.php');

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   
   /**
    *
    * @global <type> $languageCz
    */
   function showEscort() {
      global $languageCz;
      $file = $files["connect"];
      require_once ("$file");

      $navrat=mysql_query("SELECT * FROM `DOPROVODNY_TYM`;");
      while( list($id,$name, $surname, $date, $hometown, $street, $city, $zip, $state, $family, $pozicion, $team) = mysql_fetch_row($navrat) )
      {
         echo $id.$name.$surname.$date.$hometown.$street.$city.$zip.$state.$family.$pozicion.$team."<br>";
         echo "<form action='edit_team_escort.php' method='POST' >
                  <input type='hidden' name='name' value=$name>
                  <input type='hidden' name='surname' value=$surname>
                  <input type='hidden' name='pozicion' value=$pozicion>
                  <input type='hidden' name='date' value=$date>
                  <input type='hidden' name='hometown' value=$hometown>
                  <input type='hidden' name='street' value=$street>
                  <input type='hidden' name='city' value=$city>
                  <input type='hidden' name='zip' value=$zip>
                  <input type='hidden' name='state' value=$state>
                  <input type='hidden' name='family' value=$family>
                  <input type='hidden' name='team' value=$team>
                  <input type='hidden' name='check' value='false'>
                  <input type='submit' value='".$languageCz."' name='souhlas'>
             </form>";
      }
   }

   showEscort();

?>