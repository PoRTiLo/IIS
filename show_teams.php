<?php

   include 'default.php';

   session_name('RT_kontext');
   session_start();

   global $defaultLanguage;
   $_SESSION['lang']=$defaultLanguage;

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
   function showTeam() {
      global $files;
      global $text;

      echo"
         <div class=\"formular\">
         <form method=post action=".$files["addTeam"].">
         <h2><font color=red>".$text['s_teams'][$_SESSION['lang']]."</font></h2>
         <table>
         <tr>
            <td><b>".$text['s_code'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_stat'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_skupina'][$_SESSION['lang']]."</b></td>
         </tr>
      ";

      $navrat=mysql_query("SELECT * FROM `TYM`;");
      // do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
      while( list($code, $state, $group, $slogan) = mysql_fetch_row($navrat) )
      {
         echo"<tr><td>";
         echo $code."</td><td>";
         echo $state."</td><td>";
         echo $group."</td><tr>";
      }
   }
   
   showTeam();

   echo"
   </table><br>
   </form>
   </div>
   ";

?>