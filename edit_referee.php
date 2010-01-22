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
 * @todo:poresit kdyz je to zena jejio rodinny stav i u add _referee a add_team escort
 *			poresit proc se nenehraje i rodinny stav
 */
require_once('common.inc');
header("Content-Type: text/html; charset=iso-8859-2");
include 'default.php';
require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor
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
function writeFormReferee($id,$name, $surname, $date, $hometown, $street, $city, $zip, $state) {

	global $error;
	global $text;
	echo"
	<div class=\"formular\">
		<form action=\"edit_referee.php\" method=post>
			<h2><font color=red>".$error['referee']."</font></h2>
			<h2>".$text['add_referee'][$_SESSION['lang']]."</h2>
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
			<input type='hidden' name='check' value='true'>
			<input type='hidden' name='id_referee' value=\"".$id."\"'>
			<input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
		</form>
	</div>
	";
}

/**
 *	Zkontrolu vlozena data
 * @global <type> $error
 * @global <type> $text
 * @global <type> $defaultUser
 * @global <type> $czechWord
 */
function checkFormReferee() {

	global $error;
	global $text;
	global $defaultUser;
	global $czechWord;

	if( $_POST["check"]=='false' )
	{
		editReferee();
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
		//elseif( ereg("^ +$", $_POST["surname"]) ) // nesmi obsahovat mezery
		//{
		//	$error["surname"] = $text['no_surname1'][ $_SESSION['lang']];
		//}
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
		elseif( !ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})",$_POST["date"],$regs) )
		{
			$error['date']= $text['no_date1'][ $_SESSION['lang']];
		}
		else if( $regs[1]>2000 || $regs[1]<1900 || $regs[2] > 12 || $regs[2]== 0 || $regs[3]>31 || $regs[3]==0)
		{
			$error['date']= $text['no_date2'][ $_SESSION['lang']];
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
		  || !$error["street"]=="" || !$error["city"]=="" || !$error["zip"]=="" || !$error["state"]=="" || !$error["state"]=="" || !$error["family"]=="")
		{
			writeFormReferee($_POST["id_referee"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["hometown"], $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]);
		}
		else
		{
			$error["referee"] = "";
			$quastion = "UPDATE `ROZHODCI` SET `JMENO`='".$_POST["name"]."', `PRIJMENI`='".$_POST["surname"]."', `DATUM_NAROZENI`='".$_POST["date"]."',
							`RODISTE`='".$_POST["hometown"]."', `ULICE`='".$_POST["street"]."', `MESTO`='".$_POST["city"]."', `ZIP`='".$_POST["zip"]."', `STAT`='".strtoupper($_POST["state"])."', `RODINNY_STAV`='".$_POST["family"]."'
							WHERE `ID_ROZHODCI`='".$_POST["id_referee"]."';";
			$query = mysql_query($quastion);
			echo mysql_error();
			if( !$query )
			{
				echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." ROZHODCI.</h2>";
			}
			else
			{
				echo "<h2>ROZHODCI ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
			}
		}

	}
}

		function editReferee() {

			global $file;
			$edit_referee[]=array();

			$edit_referee["name"]=$_POST["name"];
			$edit_referee["surname"]=$_POST["surname"];
			$query=mysql_query("SELECT * FROM `ROZHODCI` WHERE JMENO='".$edit_referee["name"]."' and PRIJMENI='".$edit_referee["surname"]."';");

			if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
			{
				echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
			}
			else
			{
				$row = mysql_fetch_array($query);

				$edit_referee["id"] = $row["ID_ROZHODCI"];
				$edit_referee["name"]=$row["JMENO"];
				$edit_referee["surname"]=$row["PRIJMENI"];
				$edit_referee["date"]=$row["DATUM_NAROZENI"];
				$edit_referee["hometown"]=$row["RODISTE"];
				$edit_referee["street"]=$row["ULICE"];
				$edit_referee["city"]=$row["MESTO"];
				$edit_referee["zip"]=$row["ZIP"];
				$edit_referee["state"]=$row["STAT"];
				$edit_referee["family"]=$row["RODINNY_STAV"];
			}
			writeFormReferee($edit_referee["id"], $edit_referee["name"],$edit_referee["surname"],$edit_referee["date"], $edit_referee["hometown"],$edit_referee["street"],$edit_referee["city"],$edit_referee["zip"], $edit_referee["state"]);

		}
		checkFormReferee();
?>
</body>
</html>
