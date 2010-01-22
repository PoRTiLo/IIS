<?php

   include 'default.php';
   global $languageCz;
   global $defaulLanguage;
   $_SESSION['lang']=$defaultLanguage;

   session_name('RT_kontext');
   session_start();
   $file = $files["connect"];
   require_once ("$file");

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");


   /**
    *
    * @global <type> $languageCz
    * @global <type> $files
    * @global <type> $text 
    */
   function showEscort() {
      global $languageCz;
      global $files;
      global $text;

      echo"
         <div class=\"formular\">
            <form method=post action=".$files["editEscort"].">
            <h2><font color=red>".$text['s_dopshow'][$_SESSION['lang']]."</font></h2>
            <table>
            <tr>
            <td><b>".$text['s_meno'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_priezv'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_stat'][$_SESSION['lang']]."</b></td>
         </tr>
      ";
      $navrat=mysql_query("SELECT * FROM `DOPROVODNY_TYM`;");
      // do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
      while( list($id, $name, $surname, $date, $hometown, $street, $city, $zip, $state) = mysql_fetch_row($navrat) )
      {

         echo"<tr><td>";
          echo $name."</td><td>";
         echo $surname."</td><td>";
         echo $state."</td></tr>";
      }
   }

   showEscort();

   echo"
   </table><br>
   </form>
   </div>
   ";

?>