<?php

   include 'default.php';

   $file = $files['common'];
   require_once ("$file");
   session_name('RT_kontext');
   session_start();

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

   global $languageCz;
   global $defaulLanguage;
   $_SESSION['lang']=$defaultLanguage;

   $file = $files["connect"];
   require_once ("$file");


   /**
    *
    * @global <type> $languageCz
    * @global <type> $files
    * @global <type> $text 
    */
   function showTeam() {
      global $languageCz;
      global $files;
      global $text;

      echo"
         <div class=\"formular\">
            <form method=post action=".$files["editTeam"].">
            <h2><font color=red>".$text['s_editteams'][$_SESSION['lang']]."</font></h2>
            <table>
            <tr>
            <td><b>".$text['s_edit'][$_SESSION['lang']]."</b></td>
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
            echo "<form action=".$files["editTeam"]." method='POST' >
               <input type='hidden' name='code' value=$code>
               <input type='hidden' name='state' value=$state>
               <input type='hidden' name='group' value=$group>
               <input type='hidden' name='slogan' value=$slogan>
               <input type='hidden' name='check' value='false'>
               <input type='submit' value='".$languageCz."' name='souhlas'>
             </form>";
         echo"</td><td>";
         echo $code."</td><td>";
         echo $state."</td><td>";
         echo $group."</td><tr>";
      }
   }

   
   if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
   {
      if ($_SESSION["access_time"] < strtotime(A_LOG_TIME))
      {
         $file = $files['automaticLogout'];
         require_once("$file");
         exit();
      }
      $_SESSION["access_time"] = time();
      showTeam();
   }
   else
   {
      $file = $files['enter'];
      header("Location: $file");
   }

   echo"
   </table><br>
   </form>
   </div>
   ";

?>