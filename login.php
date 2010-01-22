<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="/~xsendl00/styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>

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

echo "".$text['s_menu'][0].""; 
//$_POST['pass']="user";
//$_POST['log']="user";
$password = checkEscape($_POST['pass']);
$login = checkEscape($_POST['log']);

//session_register('lang'); // registrace uživatele indikuje
//$_SESSION['lang']=$defaultLanguage;


if( isset($password) )
{
	if( empty($login) )	// prazdny login
	{
      header( 'Location: enter.php'); 
	}
	else if( empty($password) )	// prazdne heslo
	{
      header( 'Location: enter.php'); 
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

				header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/uspeslogin.php");
			}
			else
			{
            session_name('RT_kontext');
            session_start();
            $_SESSION['lang']=$defaultLanguage;
				echo $text['no_enter1'][ $_SESSION['lang']];
			header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/neuspeslogin.php");

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
</body>
</html>
