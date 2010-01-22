<?php

   include 'default.php';

   session_name('RT_kontext');
   session_start();

   $file = $files['common'];
   require_once ("$file");

   $file = $files['showHead'];
   require_once("$file");
   $file = $files['head'];
   require_once("$file");

   if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
   {
      if($_SESSION["access_time"] < strtotime(A_LOG_TIME))
      {
         session_destroy();
         $_SESSION["access_time"] = time()-strtotime("-600 days");

         $file = $files['automaticLogout'];
         require_once("$file");
         exit();
      }
      else
      {
         session_destroy();
         $_SESSION["access_time"] = time()-strtotime("-600 days");
         $file = $files['wrongRight'];
         require_once("$file");
      }
   }
   else
   {
      $file = $files['main'];
      header( "Location: $file");
   }

?>