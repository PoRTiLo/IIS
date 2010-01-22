<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
<?php
/* 
 * Pridani noveho uzivatele.
 * Zkontrolovani vstupnich dat jen na zaklade reg vyrazu, zatim bez databaze
 *
 */

header("Content-Type: text/html; charset=iso-8859-2");
include 'default.php';
require_once('common.inc');
session_name('RT_kontext');
session_start();

 $_SESSION['lang'] = 0;
$error[]=array();
$error['name']="";
$error['surname']="";
$error['login']="";
$error['pass']="";
$error['email']="";
$error['user']="";
$repeat = FALSE;

/**
 * Zobrazi formular pro pridani uzivatele
 * @global <array> $error
 * @global <array> $text
 * @param <string> $name
 * @param <string> $surname
 * @param <string> $login
 * @param <string> $pass
 * @param <string> $email
 */
			global $languageCz;
			global $defaulLanguage;
			global $text;
			$_SESSION['lang']=$defaultLanguage;
			echo "".$text['s_menu'][$_SESSION['lang']]."";
 
function writeForm($name, $surname, $login, $pass, $email) {
	global $error;
	global $text;
	
	echo"
	<div class=\"formular\">
		<form action=\"add_user.php\" method=post>
				<h2><font color=red>".$error['user']."</font></h2>
				<h2>".$text['add_player'][$_SESSION['lang']]."</h2>
				<table>
					<tr><td>".$error['name']."</tr></td>
					<tr> <td><b><font color=red>".$text['f_name'][$_SESSION['lang']]."</font></b> </td>
					<td><input type='text' name='name' value=\"".$name."\" size='20' maxlength='40' /></td></tr>
					<tr><td>".$error['surname']."</tr></td>
					<tr> <td><b><font color=red>".$text['f_surname'][$_SESSION['lang']]."</font></b> </td>
					<td><input type='text' name='surname' value=\"".$surname."\" size='20' maxlength='40' /></td></tr>
					<tr><td>".$error['login']."</tr></td>
					<tr> <td><b><font color=red>".$text['f_login'][$_SESSION['lang']]."</font></b> </td>
					<td><input type='text' name='login' value=\"".$login."\" size='20' maxlength='40' /></td></tr>
					<tr><td>".$error['pass']."</tr></td>
					<tr> <td><b><font color=red>".$text['f_pass'][$_SESSION['lang']]."</font></b> </td>
					<td><input type='password' name='pass' value=\"".$pass."\" size='20' maxlength='40' /></td></tr>
					<tr> <td><b><font color=red>".$text['f_email'][$_SESSION['lang']]."</font></b> </td>
					<td><input type='text' name='email' value=\"".$email."\" size='20' maxlength='40' /></td></tr>
				</table><br>
				<input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
		</form>
	</div>
	";
}

/**function callUser() {

			global $text;
			global $defaultLanguage;
			$pairs[$text['f_user'][$defaultLanguage]] = $text['f_user'][$defaultLanguage];
			$pairs[$text['f_admin'][ $defaultLanguage]] = $text['f_admin'][ $defaultLanguage];

			if( empty($_POST))
					echo createDropdown("pozicion", $pairs, "---", "---");
				else
					echo createDropdown("pozicion", $pairs, "---", $_POST["pozicion"]);
		}*/

/**
 * Kontrola formulare
 * @global <type> $error
 * @global <type> $text
 * @global <type> $repeat
 * @global <type> $defaultUser
 * @global <type> $czechWord
 */
 
function checkForm() {

	global $error;
	global $text;
	global $repeat;
	global $defaultUser;
	global $czechWord;
	global $regNoCzech;

	if( empty($_POST) )
	{
		 writeForm("","","","","");
	}
	else
	{
	// kontrola jmena
		if( $_POST["name"] == "" )	// jmeno nesmi byt prazdne
		{
			$error["name"] = $text['no_name'][ $_SESSION['lang']];
		}
		//elseif( ereg("^ +$", $_POST["name"]) ) // nesmi obsahovat mezery
		//{
		//	$error["name"] = $text['no_name1'][ $_SESSION['lang']];
		//}
		elseif( strlen($_POST["name"]) > 46 || strlen($_POST["name"]) < 2)
		{
			$error["name"] = $text['no_name2'][ $_SESSION['lang']];
		}
		else
			$error["name"]="";
	// kontrola prijmeni
		if( $_POST["surname"] == "" )	// prijmeni nesmi byt prazdne
		{
			$error["surname"] = $text['no_surname'][ $_SESSION['lang']];
		}
		//elseif( ereg("^ +$", $_POST["surname"]) ) // nesmi obsahovat mezery
		//{
		//	$error["surname"] = $text['no_surname1'][ $_SESSION['lang']];
		//}
		elseif( strlen($_POST["surname"]) > 46 || strlen($_POST["surname"]) < 2)
		{
			$error["surname"] = $text['no_surname2'][ $_SESSION['lang']];
		}
		else
			$error["surname"]="";
	// kontrola loginu
		if( $_POST["login"] == "" && $repeat == TRUE )	// prijmeni nesmi byt prazdne
		{
			$error["login"] = $text['no_login4'][ $_SESSION['lang']];
		}
		elseif( $_POST["login"] == "" )	// prijmeni nesmi byt prazdne
		{
			$error["login"] = $text['no_login'][ $_SESSION['lang']];
		}
		//elseif( ereg("^ +$", $_POST["login"]) ) // nesmi obsahovat mezery
		//{
		//	$error["login"] = $text['no_login1'][ $_SESSION['lang']];
		//}
		elseif( strlen($_POST["login"]) > 20 || strlen($_POST["login"]) < 2 )
		{
			$error["login"] = $text['no_login2'][ $_SESSION['lang']];
		}
		elseif( !ereg("^[[:alnum:]]*$", $_POST["login"]) )
		{
			$error["login"] = $text['no_login3'][ $_SESSION['lang']];
		}
		else
			$error["login"]="";
	// kontrola hesla
		if( $_POST["pass"] == "" )
		{
			$error['pass']= $text['no_pass'][ $_SESSION['lang']];
		}
		//elseif( ereg("^ +$",$_POST["pass"]) )
		//{
		//	$error['pass']= $text['no_pass1'][ $_SESSION['lang']];;
		//}
		elseif( strlen($_POST["pass"]) > 20 || strlen($_POST["pass"]) < 4 )
		{
			$error["pass"] = $text['no_pass2'][ $_SESSION['lang']];
		}
		elseif( !ereg("^[[:alnum:]]*$", $_POST["pass"]) )
		{
			$error["pass"] = $text['no_pass3'][ $_SESSION['lang']];
		}
		else
			$error['pass']= "";
	// kontrola emailu
		if( $_POST["email"]=="" )
		{
			$error['email']= $text['no_email'][ $_SESSION['lang']];
		}
		elseif( !ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,5}$",$_POST["email"]) )
		{
			$error['email']= $text['no_email1'][ $_SESSION['lang']];
		}
		elseif( strlen($_POST["email"]) > 100 )
		{
			$error['email']= $text['no_email2'][ $_SESSION['lang']];
		}
		//elseif( !ereg("^".$czechWord."+$", $_POST["email"]) )
		//{
		//	$error["email"] = $text['no_email3'][ $_SESSION['lang']];
		//}
		else
			$error['email']="";
	// tisk formulare
		if( !$error["name"]=="" || !$error["surname"]=="" || !$error["login"]=="" || !$error["pass"]=="" || !$error["email"]=="" )
		{
			writeForm($_POST["name"], $_POST["surname"], $_POST["login"], $_POST["pass"], $_POST["email"] );
		}
		else
		{
			require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor

			$query=mysql_query("SELECT * FROM `USER` WHERE login='".$_POST["login"]."';");

			if( mysql_num_rows($query) != 0 )	// login jiz je v databazi
			{
			  $repeat = TRUE;
			  $_POST["login"] = "";
			  checkForm();
			}
			else	// login neni v databazi
			{
				echo md5($_POST["pass"]);
				$query = mysql_query("INSERT INTO `USER`(LOGIN, PASS, JMENO, PRIJMENI, EMAIL, STAV) VALUES
							('".$_POST["login"]."','".md5($_POST["pass"])."','".$_POST["name"]."','".$_POST["surname"]."','".$_POST["email"]."','".$defaultUser."');"
							);
				if( !$query )
				{
					//$create = FALSE;
					echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." USER.</h2>";
				}
				else
				{
					echo "<h2>USER ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
				}
			}
		}

	}
}
checkForm();


?>

</body>

</html>
