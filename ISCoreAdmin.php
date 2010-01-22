<?php

   include 'default.php';
   global $text;
   global $defaulLanguage;
   session_name('RT_kontext');
   session_start();
   $_SESSION['lang']=$defaultLanguage;

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

?>