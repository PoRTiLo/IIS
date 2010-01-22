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
    * @param <type> $log
    * @param <type> $pass 
    */
   function writeForm($log, $pass) {
      global $error;
      global $text;
      global $files;
      echo"
      <div class=\"formular\">
         <form method=post action=".$files["login"].">
               <table>
                  <h4><font color=red>K dokonèení nasledujicí operace je nutné se prihlásit</font><h4>
            <tr> <td><b>Login: </b> </td> <td><input type='text' name='log' value=\"".$log."\" size='20' maxlength='40' /></td></tr>

                  <tr> <td><b>Heslo: </b> </td> <td><input type='password' name='pass' value=\"".$pass."\" size='20' maxlength='40' /></td></tr>

               <input type=submit value=Odeslat>
               </table>
         </form>
      </div>
      ";
   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   writeForm("", "");

?>
