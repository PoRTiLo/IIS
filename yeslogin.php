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
    * @global <type> $files 
    */
   function writeForm() {
      global $error;
      global $text;
      global $files;
      echo"
         <div class=\"formular\">
            <form method=post action=".$files["yesLogin"].">
                  <table>
                     <h1><font color=red>Vítejte</font><h1>
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