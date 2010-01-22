<?php
/* 
 * Script, ktery zpracovava prihlasovasi formular
 * TODO:	poresit jazyk
 *			z jine stranky mi prijdou udaje o prihlaseni
 *			zkontrolovat zda nejsou prazdne
 *			pripojot k databazi
 *			zjistit typ prihlaseni
 *			prohledat databazi
 *				uspech=>vytvorit cookies
 *				neuspech=>vratit zadat nova data nebo otevrit stranku s novoou registraci
 */

   include 'default.php';
   include $files['text'];	// katalog textových konstant
   include $files['const'];

   require_once('show_head.php');
   require_once('head.php');
   
   $password = checkEscape($_POST['pass']);
   $login = checkEscape($_POST['log']);
   $file = $files["enter"];
   if( isset($password) )
   {
      if( empty($login) )	// prazdny login
      {
         header( "Location: $file");
      }
      else if( empty($password) )	// prazdne heslo
      {
         header( "Location: $file");
      }
      else	// vse v poradku, pripojime se k databazi a tam zkontrolujem pravost udaju
      {

         $query = mysql_query("SELECT * FROM `USER` WHERE `LOGIN`='".$login."' AND `PASS`='".md5($password)."';");

         if( !$query )
         {
            echo $text['no_query'][ $_SESSION['lang']];
         }
         else
         {
            $found = mysql_fetch_array($query); // vraci pole hodnot nacteneho zaznamu nebo FALSE (je prazdny)

            if( $found ) // pokud je uzivatel v databazi/ vytvorime mu session
            {
               session_name('RT_kontext');
               session_set_cookie_params(300);
               session_start();
               $_SESSION['login']=$login;
               $_SESSION['name']=$found['JMENO'];
               $_SESSION['surname']=$found['PRIJMENI'];

               $_SESSION['email']=$found['EMAIL'];
               $_SESSION['result']=$found['STAV'];
               $_SESSION['lang']=0;

               $_SESSION["access_time"] = time();
               
               $file = $files["yesLogin"];
               header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/$file");
            }
            else
            {
               session_name('RT_kontext');
               session_start();
               $_SESSION['lang']=$defaultLanguage;
               echo $text['no_enter1'][ $_SESSION['lang']];

               $file = $files["noLogin"];
               header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/$file");
            }
         }
      }
   }
   else
   {
      session_name('RT_kontext');
      session_start();
      $_SESSION['lang']=$defaultLanguage;
      echo $text['no_enter'][ $_SESSION['lang']];
   }

?>