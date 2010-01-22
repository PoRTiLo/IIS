<?php

   include 'default.php';

   session_name('RT_kontext');
   session_start();

   global $languageCz;
   global $defaulLanguage;
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
   function showMatch() {
      global $files;
      global $text;

      echo"
         <div class=\"formular\">
            <form method=post action=".$files["editReferee"].">
            <h2><font color=red>".$text['s_refshow'][$_SESSION['lang']]."</font></h2>
            <table>
            <tr>
               <td><b>".$text['s_date'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_skupina'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_home'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_guest'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_score'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_type'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_time'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_people'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_ref1'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_ref2'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_ref3'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_ref4'][$_SESSION['lang']]."</b></td>
            </tr>
      ";

      $navrat=mysql_query("SELECT * FROM `ZAPAS`;");
      while( list($id, $date, $place, $home, $guest, $score, $time, $people, $type, $referee1, $referee2, $referee3, $referee4, $list1, $list2, $group) = mysql_fetch_row($navrat) )
      {
         echo"<tr><td>";
         echo $date."</td><td>";
         echo $group."</td><td>";
         echo $home."</td><td>";
         echo $guest."</td><td>";
         echo $score."</td><td>";
         echo $type."</td><td>";
         echo $time."</td><td>";
         echo $people."</td><td>";
         $query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee1."';");
         $row = mysql_fetch_array($query);
         $referee1 = $row["PRIJMENI"];
         echo $referee1."</td><td>";
         $query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee2."';");
         $row = mysql_fetch_array($query);
         $referee2 = $row["PRIJMENI"];
         echo $referee2."</td><td>";
         $query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee3."';");
         $row = mysql_fetch_array($query);
         $referee3 = $row["PRIJMENI"];
         echo $referee3."</td><td>";
         $query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee4."';");
         $row = mysql_fetch_array($query);
         $referee4 = $row["PRIJMENI"];
         echo $referee4."</td></tr>";
      }
   }

   showMatch();
   
   echo"
   </table><br>
   </form>
   </div>
   ";

?>