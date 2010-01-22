<?php

   if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
   {
      if ($_SESSION["access_time"] < strtotime(A_LOG_TIME))
      {
         require_once('automatic_loggout.php');
         exit();
      }
      $_SESSION["access_time"] = time();
      checkForm();
   }
   else
   {
      header( 'Location: enter.php');
   }

?>