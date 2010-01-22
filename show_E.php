<?php

   include 'default.php';

   session_name('RT_kontext');
   session_start();
   $_SESSION['lang'] = 0;

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

   $file = $files["connect"];
   require_once ("$file");


   /**
    *
    * @global <type> $files
    * @global <type> $text 
    */
   function showGroups(){
      global $files;
      global $text;

      echo"
         <div class=\"formular\">
            <form method=post action=".$files["addTeam"].">
            <h2><font color=red>".$text['s_skE'][$_SESSION['lang']]."</font></h2>
            <table>
      ";

      $navrat=mysql_query("SELECT * FROM `SKUPINA` WHERE JMENO='E';");
      // do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
      while( list($name, $city, $team_1, $team_2, $team_3, $team_4) = mysql_fetch_row($navrat) )
      {
         echo"<tr><td><b>".$text['s_mesto'][$_SESSION['lang']]."</b></td><td>";
         echo $city."</td></tr>";

             echo"<tr><td><b>".$text['s_tym1'][$_SESSION['lang']]."</b></td><td>";
         echo $team_1."</td></tr>";

         echo"<tr><td><b>".$text['s_tym2'][$_SESSION['lang']]."</b></td><td>";
         echo $team_2."</td></tr>";

         echo"<tr><td><b>".$text['s_tym3'][$_SESSION['lang']]."</b></td><td>";
         echo $team_3."</td></tr>";

         echo"<tr><td><b>".$text['s_tym4'][$_SESSION['lang']]."</b></td><td>";
         echo $team_4."</td></tr>";
      }
   }

   showGroups();

   echo"

   </table><br>
   </form>
   </div>
   ";

?>