<?php

   include 'default.php';
   global $languageCz;
   global $defaulLanguage;
   $_SESSION['lang']=$defaultLanguage;
   $file = $files["connect"];
   require_once ("$file");
   $file = $files['common'];
   require_once ("$file");

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

   session_name('RT_kontext');
   session_start();


   /**
    *
    * @global <type> $text
    * @global <type> $languageCz 
    */
   function showPlayer() {
      global $text;
      global $files;
      global $languageCz;

      echo"
         <div class=\"formular\">
            <form method=post action=".$files["editPlayer"].">
            <h2><font color=red>".$text['s_editplayer'][$_SESSION['lang']]."</font></h2>
            <table>
            <tr>
            <td><b>".$text['s_edit'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_meno'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_priezv'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_pozicia'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_domklub'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_stat'][$_SESSION['lang']]."</b></td>
            <td><b>".$text['s_team'][$_SESSION['lang']]."</b></td>
            </tr>
      ";

      $navrat=mysql_query("SELECT * FROM `HRAC`;");
      while( list($id,$name, $surname, $pozicion, $date, $home_club, $hometown, $last_club, $street, $city, $zip, $state, $family, $team) = mysql_fetch_row($navrat) )
      {
         echo"<tr><td>";
         echo "<form action=".$files["editPlayer"]." method='POST' >
               <input type='hidden' name='name' value=$name>
               <input type='hidden' name='surname' value=$surname>
               <input type='hidden' name='pozicion' value=$pozicion>
               <input type='hidden' name='date' value=$date>
               <input type='hidden' name='home_club' value=$home_club>
               <input type='hidden' name='hometown' value=$hometown>
               <input type='hidden' name='last_club' value=$last_club>
               <input type='hidden' name='street' value=$street>
               <input type='hidden' name='city' value=$city>
               <input type='hidden' name='zip' value=$zip>
               <input type='hidden' name='state' value=$state>
               <input type='hidden' name='family' value=$family>
               <input type='hidden' name='team' value=$team>
               <input type='hidden' name='check' value='false'>
               <input type='submit' value='".$languageCz."' name='souhlas'>
             </form>";
         echo "</td><td>";
         echo $name."</td><td>";
         echo $surname."</td><td>";
         echo $pozicion."</td><td>";
         echo $home_club."</td><td>";
         echo $state."</td><td>";
         echo $team."</td></tr>";
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

      showPlayer();
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