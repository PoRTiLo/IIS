<?php

   include 'default.php';
   $file = $files["connect"];
   require_once ("$file");
   $file = $files['common'];
   require_once ("$file");
   global $languageCz;
   global $defaulLanguage;
   $_SESSION['lang']=$defaultLanguage;

   session_name('RT_kontext');
   session_start();

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
   function showAction() {
      global $languageCz;
      global $files;
      global $text;

      echo"
         <div class=\"formular\">
            <form method=post action=".$files["addActionN"].">
            <h2><font color=red>".$text['s_akcedit'][$_SESSION['lang']]."</font></h2>
            <table>
            <tr>
               <td><b>".$text['s_edit'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_id'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_zapas'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_typ'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_hrac'][$_SESSION['lang']]."</b></td>
               <td><b>".$text['s_minuta'][$_SESSION['lang']]."</b></td>
            </tr>
         ";

      $navrat=mysql_query("SELECT * FROM `AKCE`;");
      while( list($id, $minute, $type, $player, $match) = mysql_fetch_row($navrat) )
      {
         echo"<tr><td>";
            echo "<form action=".$files["addActionN"]." method='POST' >
               <input type='hidden' name='id_akce' value=$id>
               <input type='hidden' name='minuta' value=$minute>
               <input type='hidden' name='typ_akce' value=$type>
               <input type='hidden' name='hrac' value=$player>
               <input type='hidden' name='zapas' value=$match>
               <input type='hidden' name='check' value='false'>
               <input type='submit' value='".$languageCz."' name='souhlas'>
             </form>";
         echo "</td><td>";
         echo $id."</td><td>";
         echo $match."</td><td>";
         echo $type."</td><td>";
         echo $player."</td><td>";
         echo $minute."</td></tr>";
      }
   }

   showAction();

   echo"
   </table><br>
   </form>
   </div>
   ";

?>