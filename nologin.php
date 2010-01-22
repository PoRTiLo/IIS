<?php

   include 'default.php';
   session_name('RT_kontext');
   session_start();

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

   $file = $files['common'];
   require_once ("$file");
   global $defaultLanguage;
   $_SESSION['lang']=$defaultLanguage;

   function writeForm($log, $pass) {
      global $error;
      global $text;
      echo"
         <div class=\"formular\">
            <form method=post action=\"neuspeslogin.php\">
                  <table>
                           <h4><font color=red>Prihlasovaní neprobìhlo úspesne</font><h4>
                            <tr><td><a href="."enter.php".">Prosím prihlašte se</a></td></tr>
                  </table>
            </form>
         </div>
      ";
   }
   writeForm();
?>

