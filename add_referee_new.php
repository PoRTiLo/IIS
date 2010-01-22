<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
<?php
/*
 * Pridani noveho hrace.
 * Zkontrolovani vstupnich dat jen na zaklade reg vyrazu, zatim bez databaze
 *
 * @todo: DOdelat kontrolu mailu a hlavne ceske znaky zby jen ony a ne cisla
 *				POZOOOOOOOOOOOOOOOR pri zadávani v anglictine se pozice hracu ulozi do databaze anglicky(mozna nevadi) :-)
 *			dodelat kontrolu datumu
 *			dodelat kontrolu statu, zadat jen zkratku, treba posuvni s tema co existuju
 *			zkontroloat u vyberu jestli po znovu nacteni zustane vybrano nebo se musi vybrat znovu :(
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
$error['date']="";
$error['hometown']="";
$error['street']="";
$error['city']="";
$error['zip']="";
$error['state']="";
$error['family']="";
$error['referee']="";

/**
 *	Vypise formular
 * @global <type> $error
 * @global <type> $text
 * @param <type> $name
 * @param <type> $surname
 * @param <type> $date
 * @param <type> $hometown
 * @param <type> $street
 * @param <type> $city
 * @param <type> $zip
 * @param <type> $state
 */
 
echo "".$text['s_menu'][$_SESSION['lang']]."";
function writeForm($name, $surname, $date, $hometown, $street, $city, $zip, $state) {
	
	global $error;
	global $text;
	echo"
	<div class=\"formular\">
		<form action=\"add_referee_new.php\" method=post>
			<h4><font color=red>".$error['referee']."</font></h4>
			<h4>".$text['add_referee'][$_SESSION['lang']]."</h4>
			<table>
				<tr><td>".$error['name']."</td> </tr>
				<tr> <td><b><font color=red>".$text['f_name'][$_SESSION['lang']]."</font></b></td>
				<td><input type='text' name='name' value=\"".$name."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['surname']."</td> </tr>
				<tr> <td><b><font color=red>".$text['f_surname'][$_SESSION['lang']]."</font></b></td>
				<td><input type='text' name='surname' value=\"".$surname."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['date']."</td> </tr>
				<tr> <td><b><font color=red>".$text['f_date'][$_SESSION['lang']]."</font></b></td>
				<td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['hometown']."</td> </tr>
				<tr> <td><b><font color=red>".$text['f_hometown'][$_SESSION['lang']]."</font></b></td>
				<td><input type='text' name='hometown' value=\"".$hometown."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['street']."</td> </tr>
				<tr> <td><b>".$text['f_street'][$_SESSION['lang']]."</b></td>
				<td><input type='text' name='street' value=\"".$street."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['city']."</td> </tr>
				<tr> <td><b>".$text['f_city'][$_SESSION['lang']]."</b></td>
				<td><input type='text' name='city' value=\"".$city."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['zip']."</td> </tr>
				<tr> <td><b>".$text['f_zip'][$_SESSION['lang']]."</b></td>
				<td><input type='text' name='zip' value=\"".$zip."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['state']."</td> </tr>
				<tr> <td><b>".$text['f_state'][$_SESSION['lang']]."</b></td>
				<td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
				<tr><td>".$error['family']."</td></tr>
				<tr> <td><b><font color=red>".$text['f_family'][$_SESSION['lang']]."</font>
				<td> ";echo callDropdownFamily()."</td></tr>
			</table><br>
			<input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
		</form>
	</div>
	";
}
/*
    V tuto chvíli je uživatel na stránce poprvé. Vypíšeme formulář.
    Protože uživatel ještě nic nenapsal, bude formulář prázdný.
*/

/**
 *	Zkontrolu vlozena data
 * @global <type> $error
 * @global <type> $text
 * @global <type> $defaultUser
 * @global <type> $czechWord
 */
function checkForm() {

	global $error;
	global $text;
	global $defaultUser;
	global $czechWord;

	if( empty($_POST) )
	{
		 writeForm("","","","","","","","");
	}
	else
	{
	// kontrola jmena
		if( $_POST["name"] == "" )	// jmeno nesmi byt prazdne
		{
			$error["name"] = $text['no_name'][ $_SESSION['lang']];
		}
		elseif( ereg("^ +$", $_POST["name"]) ) // nesmi obsahovat mezery
		{
			$error["name"] = $text['no_name1'][ $_SESSION['lang']];
		}
		elseif( strlen($_POST["name"]) > 50 || strlen($_POST["name"]) < 2)
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
		elseif( ereg("^ +$", $_POST["surname"]) ) // nesmi obsahovat mezery
		{
			$error["surname"] = $text['no_surname1'][ $_SESSION['lang']];
		}
		elseif( strlen($_POST["surname"]) > 50 || strlen($_POST["surname"]) < 2)
		{
			$error["surname"] = $text['no_surname2'][ $_SESSION['lang']];
		}
		else
			$error["surname"]="";
// kontrola datumu narozeni
		if( $_POST["date"] == "" )
		{
			$error['date']= $text['no_date'][ $_SESSION['lang']];
		}
		elseif( !ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})",$_POST["date"]) )
		{
			$error['date']= $text['no_date1'][ $_SESSION['lang']];;
		}
		else
			$error['date']= "";
// kotrolo rodiste
		if( $_POST["hometown"] == "" )
		{
			$error['hometown']= $text['no_hometown'][ $_SESSION['lang']];
		}
		elseif( strlen($_POST["hometown"]) > 25 )
		{
			$error["hometown"] = $text['no_hometown1'][ $_SESSION['lang']];
		}
		else
			$error['hometown']= "";
// kontrola ulice
		if( strlen($_POST["street"]) > 20 )
		{
			$error["street"] = $text['no_street'][ $_SESSION['lang']];
		}
		else
			$error['street']= "";
// kontrola mesta
		if( strlen($_POST["city"]) > 20 )
		{
			$error["city"] = $text['no_city'][ $_SESSION['lang']];
		}
		else
			$error['city']= "";
// kontrola ZIP
		if( $_POST["zip"] == "" )
		{
			$error['zip']= "";
		}
		else
		{
			if( !ereg("^([0-9]{4,5})$",$_POST["zip"]) )
			{
				$error['zip']= $text['no_zip'][ $_SESSION['lang']];;
			}
			else
				$error['zip']= "";
		}
// kontrola rodinneho stavu
		if( $_POST["family"] == "---" )
		{
			$error['family']= $text['no_family'][ $_SESSION['lang']];
		}
		else
			$error['family']= "";
// kontrola statu
		if( $_POST["state"] == "" )
		{
			$error['state']= "";
		}
		else
		{
			if( strlen($_POST["state"]) > 3 || strlen($_POST["state"]) < 2 )
				{
				$error["state"] = $text['no_state'][ $_SESSION['lang']];
			}
			else
				$error['state']= "";
		}
	// tisk formulare
		if( !$error["name"]=="" || !$error["surname"]=="" || !$error["date"]=="" || !$error["hometown"]==""
		  || !$error["street"]=="" || !$error["city"]=="" || !$error["zip"]=="" || !$error["state"]=="" || !$error["state"]=="")
		{
			writeForm($_POST["name"], $_POST["surname"], $_POST["date"], $_POST["hometown"], $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]);
		}
		else
		{
			require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor

			$query=mysql_query("SELECT * FROM `ROZHODCI` WHERE jmeno='".$_POST["name"]."' and
																		  prijmeni='".$_POST["surname"]."';");

			if( mysql_num_rows($query) != 0 )	// hrac je jiz v databazi
			{
			  $error["referee"] = $text['no_referee'][ $_SESSION['lang']];
			  $_POST["name"] = "";
			  $_POST["surname"] = "";
			  checkForm();
			}
			else	// hrac neni v databazi
			{
				$error["referee"] = "";
				$query = mysql_query("INSERT INTO `ROZHODCI`
								(JMENO, PRIJMENI, DATUM_NAROZENI, RODISTE, ULICE, MESTO, ZIP, STAT, RODINNY_STAV) VALUES
								('".$_POST["name"]."', '".$_POST["surname"]."', '".$_POST["date"]."', '".$_POST["hometown"]."', '".$_POST["street"]."', '".$_POST["city"]."', '".$_POST["zip"]."', '".$_POST["state"]."', '".$_POST["family"]."');"
							);
				if( !$query )
				{
					echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." HRAC.</h2>";
				}
				else
				{
					echo "<h2>ROZHODCI ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					echo"vypsat to co se tam dalo";
				}
			}
		}

	}
}
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
</body>

</html>
