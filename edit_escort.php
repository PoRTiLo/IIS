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
		 */

		//header("Content-Type: text/html; charset=iso-8859-2");
		include 'default.php';
require_once('common.inc');
		require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor

		session_name('RT_kontext');
		session_start();

		$_SESSION['lang'] = 0;
		$error[]=array();
		$error['name']="";
		$error['surname']="";
		$error['date']="";
		$error['home_club']="";
		$error['hometown']="";
		$error['last_club']="";
		$error['street']="";
		$error['city']="";
		$error['zip']="";
		$error['state']="";
		$error['team']="";
		$error['escort']="";
		$error['family']="";
		$error['pozicion']="";

		/**
		 * Zobrazi formular pro pridani hrace
		 * @global <type> $error
		 * @global <type> $text
		 * @global <type> $languageCz
		 * @param <type> $name
		 * @param <type> $surname
		 * @param <type> $date
		 * @param <type> $home_club
		 * @param <type> $hometown
		 * @param <type> $last_club
		 * @param <type> $street
		 * @param <type> $city
		 * @param <type> $zip
		 * @param <type> $state
		 */
		function writeFormEscort($id, $name, $surname, $date, $hometown, $street, $city, $zip, $state) {
			global $error;
			global $text;
			global $languageCz;
			 echo "".$text['s_menu'][$_SESSION['lang']]."";
			echo "
			<div class=\"formular\">
				<form action=\"edit_escort.php\" method=post>
					<h2><font color=red>".$error['escort']."</font></h2>
					<h2>".$text['add_escort'][$_SESSION['lang']]."</h2>
					<table>
						<tr><td>".$error['name']."</td> </tr>
					  <tr> <td><b><font color=red>".$text['f_name'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='name' value=\"".$name."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['surname']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_surname'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='surname' value=\"".$surname."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['date']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_date'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
						<tr><td>".$error['hometown']."</td></tr>
					  <tr> <td><b><font color=red>".$text['f_hometown'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='hometown' value=\"".$hometown."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['family']."</td></tr>
					 <tr> <td><b><font color=red>".$text['f_family'][$_SESSION['lang']]."</font></b></td> <td> ";echo callDropdownFamily()."</td></tr>
						<tr><td>".$error['street']."</td></tr>
						 <tr> <td><b>".$text['f_street'][$_SESSION['lang']]."</b></td> <td><input type='text' name='street' value=\"".$street."\" size='20' maxlength='40' /></td></tr>
						 <tr><td>".$error['city']."</td></tr>
						  <tr> <td><b>".$text['f_city'][$_SESSION['lang']]."</b></td> <td><input type='text' name='city' value=\"".$city."\" size='20' maxlength='40' /></td></tr>
						  <tr><td>".$error['zip']."</td></tr>
							<tr> <td><b>".$text['f_zip'][$_SESSION['lang']]."</b></td> <td><input type='text' name='zip' value=\"".$zip."\" size='20' maxlength='40' /></td></tr>
							<tr><td>".$error['pozicion']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_escort_pozicion'][$_SESSION['lang']]."</font></b></td> <td>" ; echo callDropdownPozicionEscort()."</td></tr>
							<tr><td>".$error['state']."</td></tr>
						<tr> <td><b>".$text['f_state'][$_SESSION['lang']]."</b></td> <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
						<tr><td>".$error['team']."</td></tr>
						<tr> <td><b><font color=red>".$text['f_team'][$_SESSION['lang']]."</font></b></td> <td> "; echo fillDropdownTeam()."</td></tr>
					</table><br>
						<input type='hidden' name='check' value='true'>
						<input type='hidden' name='id_escort' value=\"".$id."\"'>
						<input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
				</div>
				</form>
				";

		}


		/**
		 *
		 * @global <type> $error
		 * @global <type> $text
		 * @global <type> $defaultUser
		 * @global <type> $czechWord
		 */
		function checkFormEscort() {

			global $error;
			global $text;
			global $defaultUser;
			global $czechWord;

			if( $_POST["check"]=='false' )
			{
				editEscort();
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
		// kontrola rodinneho stavu
				if( $_POST["family"] == "---" )
				{
					$error['family']= $text['no_family'][ $_SESSION['lang']];
				}
				else
					$error['family']= "";
		// kontrola pozice
				if( $_POST["pozicion"] == "---" )
				{
					$error['pozicion']= $text['no_pozicion'][ $_SESSION['lang']];
				}
				else
					$error['pozicion']= "";
		// kontrol tymu
				if( $_POST["team"] == "---" )
				{
					$error['team']= $text['no_team'][ $_SESSION['lang']];
				}
				else
					$error['team']= "";
			// tisk formulare
				if( !$error["name"]=="" || !$error["surname"]=="" || !$error["date"]=="" || !$error["hometown"]==""
					|| !$error["street"]=="" || !$error["city"]=="" || !$error["zip"]=="" || !$error["state"]==""
					|| !$error["team"]=="" || !$error["family"]==""	|| !$error["pozicion"]==""	)
				{
					writeFormEscort($_POST["id_escort"], $_POST["name"], $_POST["surname"], $_POST["date"],  $_POST["hometown"],
								 $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]); //odebran $_POST["team"]
				}
				else
				{
					$error["escort"] = "";
					$quastion = "UPDATE `DOPROVODNY_TYM` SET `JMENO`='".$_POST["name"]."', `PRIJMENI`='".$_POST["surname"]."', `POZICE`='".$_POST["pozicion"]."', `DATUM_NAROZENI`='".$_POST["date"]."',
								`RODISTE`='".$_POST["hometown"]."', `ULICE`='".$_POST["street"]."', `MESTO`='".$_POST["city"]."', `ZIP`='".$_POST["zip"]."', `STAT`='".strtoupper($_POST["state"])."', `RODINNY_STAV`='".$_POST["family"]."', `TYM`='".StrToUpper($_POST["team"])."'
								WHERE `ID_DOPROVODNY_TYM`='".$_POST["id_escort"]."';";

					$query = mysql_query($quastion);
					if( !$query )
					{
						echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." DOPROVODNY_TYM.</h2>";
					}
					else
					{
						echo "<h2>DOPROVODNY_TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}
				}

			}
		}

		function editEscort() {

			global $file;
			$edit_escort[]=array();

			$edit_escort["name"]=$_POST["name"];
			$edit_escort["surname"]=$_POST["surname"];
			$edit_escort["team"]=$_POST["team"];
			$query=mysql_query("SELECT * FROM `DOPROVODNY_TYM` WHERE JMENO='".$edit_escort["name"]."' and PRIJMENI='".$edit_escort["surname"]."' and TYM='".$edit_escort["team"]."';");

			if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
			{
				echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
			}
			else
			{
				$row = mysql_fetch_array($query);

				$edit_escort["id"] = $row["ID_DOPROVODNY_TYM"];
				$edit_escort["name"]=$row["JMENO"];
				$edit_escort["surname"]=$row["PRIJMENI"];
				$edit_escort["date"]=$row["DATUM_NAROZENI"];
				$edit_escort["hometown"]=$row["RODISTE"];
				$edit_escort["street"]=$row["ULICE"];
				$edit_escort["city"]=$row["MESTO"];
				$edit_escort["zip"]=$row["ZIP"];
				$edit_escort["state"]=$row["STAT"];
				$edit_escort["family"]=$row["RODINNY_STAV"];
				$edit_escort["pozicion"]=$row["POZICE"];
				$edit_escort["team"] =$row["TYM"];
			}
			writeFormEscort($edit_escort["id"], $edit_escort["name"],$edit_escort["surname"],$edit_escort["date"],
								$edit_escort["hometown"],$edit_escort["street"],$edit_escort["city"],$edit_escort["zip"], $edit_escort["state"]);

		}
	if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
		{
			if ($_SESSION["access_time"] < strtotime(A_LOG_TIME))
			{
				require_once('automatic_loggout.php');
				exit();
			}
			$_SESSION["access_time"] = time();


			checkFormEscort();
		}
		else
		{	
			header( 'Location: enter.php'); 		
		}

		

	?>
</body>

</html>
