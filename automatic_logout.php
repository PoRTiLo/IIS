<?php

   include 'default.php';
   session_name('RT_kontext');
   session_start();
   $file = $files['common'];
   require_once ("$file");
   global $defaultLanguage;
   $_SESSION['lang']=$defaultLanguage;


   /**
    *
    * @global <type> $error
    * @global <type> $text
    */
   function writeForm() {
      global $error;
      global $text;
      echo"
      <div class=\"formular\">
         <form method=post action=".$files["automaticLogout"].">
               <table>
                  <h1><font color=red>Automaticky odhl�sen</font><h1>
                  <tr><td><a href=".$files["hlavniStrana"].">Prosim pokracujte</a></td></tr>
               </table>
         </form>
      </div>
      ";
   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   writeForm();

?>