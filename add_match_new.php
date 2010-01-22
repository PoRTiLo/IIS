<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
	<?php
		/*
		 * Pridani noveho zapasu.
		 * Zkontrolovani vstupnich dat jen na zaklade reg vyrazu, zatim bez databaze
		 *
		 * @todo: kontola datumu
		 *			kontrola reg vyrazu u PEOPLE
		 */

		//header("Content-Type: text/html; charset=iso-8859-2");
		include 'default.php';
      require_once('common.inc');
		session_name('RT_kontext');
		session_start();


		$_SESSION['lang'] = 0;
		$error[]=array();
		$error['date']="";
		$error['place']="";
		$error['score']="";
		$error['over_time']="";
		$error['people']="";
		$error['type']="";
		$error['match']="";
		$error['home']="";
		$error['guest']="";
		$error['referee']="";
		$error['referee2']="";
		$error['referee3']="";
		$error['referee4']="";
		$error['list']="";
		$error['list2']="";
		$error['referee_1']= "";
		$error['referee_2']= "";
		$error['referee_3']= "";
		$error['referee_4']= "";
		$error['home_1']= "";
		$error['guest_1']= "";
		$error['list_1']= "";

		
		function writeForm($date, $place, $score, $over_time, $people) {

			require_once('common.inc');
			global $error;
			global $text;
			global $languageCz;
  			echo "".$text['s_menu'][$_SESSION['lang']]."";
			echo "
			<div class=\"formular\">
				<form action=\"add_match_new.php\" method=post>
					<h2><font color=red>".$error['match']."</font></h2>
					<h2>".$text['add_match'][$_SESSION['lang']]."</h2>
					<table>
						<tr><td>".$error['date']."</td> </tr>
					  <tr> <td><b><font color=red>".$text['t_date'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['place']." </td></tr>
					  <tr> <td><b><font color=red>".$text['t_place'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='place' value=\"".$place."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['type']." </td></tr>
					  <tr> <td><b><font color=red>".$text['t_type'][$_SESSION['lang']]."</font></b></td> <td>"; echo callDropdownPozicionType().fillDropdownGroup()."</td></tr>
						<tr><td>".$error['home']." </td></tr>
						<tr><td>".$error['home_1']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_home_club'][$_SESSION['lang']]."</font></b></td> <td>"; 
						echo fillDropdownTeam()."</td></tr>
						<tr><td>".$error['guest']." </td></tr>
						<tr><td>".$error['guest_1']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_guest_club'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownTeam2()."</td></tr>		  
					  <tr><td>".$error['referee2']." </td></tr>
					  <tr><td>".$error['referee_2']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_referee2'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee2()."</td></tr>
					  <tr><td>".$error['referee3']." </td></tr>
					  <tr><td>".$error['referee_3']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_referee3'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee3()."</td></tr>
					  <tr><td>".$error['referee4']." </td></tr>
					  <tr><td>".$error['referee_4']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_referee4'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee4()."</td></tr>
						<tr><td>".$error['referee']." </td></tr>
						<tr><td>".$error['referee_1']." </td></tr>
					  <tr> <td><b><font color=red>".$text['f_referee'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee()."</td></tr>
					  <tr><td>".$error['score']." </td></tr>
					  <tr> <td><b>".$text['t_score'][$_SESSION['lang']]."</b></td> <td><input type='text' name='score' value=\"".$score."\" size='20' maxlength='40' /></td></tr>
						<tr><td>".$error['over_time']." </td></tr>
					  <tr> <td><b>".$text['t_over_time'][$_SESSION['lang']]."</b></td> <td><input type='text' name='over_time' value=\"".$over_time."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['people']."</td></tr>
					  <tr> <td><b>".$text['t_people'][$_SESSION['lang']]."</b></td> <td><input type='text' name='people' value=\"".$people."\" size='20' maxlength='40' /></td></tr>
					  <tr><td>".$error['list_1']."</td></tr>
					  <tr> <td><b>".$text['t_list'][$_SESSION['lang']]."</b></td> <td>";echo fillDropdownList()."</td></tr>
					  <tr><td>".$error['list_1']."</td></tr>
					  <tr> <td><b>".$text['t_list2'][$_SESSION['lang']]."</b></td> <td>";echo fillDropdownList2()."</td></tr>
					</table>
						<input type=submit value=Odeslat>
				</form>
				</div>
				";

		}

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

			if( empty($_POST) )
			{
				 writeForm("","","","","");
			}
			else
			{
		// kontrola datumu zapasi
				if( $_POST["date"] == "" )
				{
					$error['date']= $text['no_date'][ $_SESSION['lang']];
				}
				elseif( !ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",$_POST["date"], $regs) )
				{
					$error['date']= $text['no_date1'][ $_SESSION['lang']];;
				}
				else
					$error['date']= "";
		// kotrolo mista zapasu
				if( $_POST["place"] == "" )
				{
					$error['place']= $text['no_place'][ $_SESSION['lang']];
				}
				elseif( strlen($_POST["place"]) > 25 )
				{
					$error["place"] = $text['no_place1'][ $_SESSION['lang']];
				}
				else
					$error['place']= "";
		// kontrola skore
				if( $_POST["score"] == "" )
				{
					$error['score']= "";
				}
				else if( strlen($_POST["score"]) > 5 )
				{
					$error["score"] = $text['no_score'][ $_SESSION['lang']];
				}
				else if( !ereg("^([0-9]{1,2}):([0-9]{1,2})$",$_POST["score"]) )	// musi mit tvar xx:xx
				{
					$error["score"] = $text['no_score1'][ $_SESSION['lang']];
				}
				else
					$error['score']= "";
		// kontrola nastaveni
				if( $_POST["over_time"] == "" )
				{
					$error['over_time']= "";
				}
				else if( !ereg("^([1-9]{0,1})([0-9]{1})$",$_POST["over_time"]) )	// obsahovat jen cisla
				{
					$error["over_time"] = $text['no_over_time'][ $_SESSION['lang']];
				}
				else if( $_POST["over_time"] > 20 )
				{
					$error["over_time"] = $text['no_over_time1'][ $_SESSION['lang']];
				}
				else
					$error['over_time']= "";
		// kontrola poctu lidi
				if( $_POST["people"] == "" )
				{
					$error['people']= "";
				}
				else if( !ereg("^([1-9]{0,1})([0-9]{1})$",$_POST["people"]) )	// obsahovat jen cisla
				{
					$error["people"] = $text['no_people'][ $_SESSION['lang']];
				}
				else if( $_POST["people"] > 200000 )	// jen cisla do 200 000
				{
					$error["people"] = $text['no_people1'][ $_SESSION['lang']];
				}
				else
					$error['people']= "";
		// kontrola typu zapasu
				if( $_POST["type"] == "---" )
				{
					$error['type']= $text['no_type'][ $_SESSION['lang']];
				}
				else if( $_POST["type"] == "skupina" && $_POST["group"] == "-")
				{
					$error['type']= $text['no_group'][ $_SESSION['lang']];
				}
				else
					$error['type']= "";
		// domaci
				if( $_POST["team"] == $_POST["team2"] && ($_POST["team2"]!="---" || $_POST["team2"]!="---") )
				{
					$error['home_1']= $text['no_team3'][ $_SESSION['lang']];
					$error['guest_1']= $text['no_team3'][ $_SESSION['lang']];
				}
				else
				{
					$error['home_1']= "";
					$error['guest_1']= "";
				}
				if( $_POST["list"] == $_POST["list2"] && ($_POST["list"]!="---" || $_POST["list2"]!="---") )
				{
					$error['list_1']= $text['no_list'][ $_SESSION['lang']];
				}
				else
				{
					$error['list_1']= "";
				}
				if( $_POST["team"] == "---" )
				{
					$error['home']= $text['no_team'][ $_SESSION['lang']];
				}
				else
					$error['home']= "";
		// hoste
				if( $_POST["team2"] == "---" )
				{
					$error['guest']= $text['no_team'][ $_SESSION['lang']];
				}
				else
					$error['guest']= "";
				// hoste
				if( ($_POST["referee"] == $_POST["referee2"] && ($_POST["referee"]!="---" || $_POST["referee2"]!="---")) ||
					($_POST["referee"] == $_POST["referee3"] && ($_POST["referee"]!="---" || $_POST["referee3"]!="---")) ||
					($_POST["referee"] == $_POST["referee4"] && ($_POST["referee"]!="---" || $_POST["referee4"]!="---")) ||
					($_POST["referee2"] == $_POST["referee3"] && ($_POST["referee2"]!="---" || $_POST["referee3"]!="---")) ||
					($_POST["referee3"] == $_POST["referee4"] && ($_POST["referee2"]!="---" || $_POST["referee4"]!="---")) ||
					($_POST["referee4"] == $_POST["referee3"] && ($_POST["referee3"]!="---" || $_POST["referee4"]!="---"))
				)
				{
					$error['referee_1']= $text['no_referee'][ $_SESSION['lang']];
					$error['referee_2']= $text['no_referee'][ $_SESSION['lang']];
					$error['referee_3']= $text['no_referee'][ $_SESSION['lang']];
					$error['referee_4']= $text['no_referee'][ $_SESSION['lang']];
				}
				else
				{
					$error['referee_1']= "";
					$error['referee_2']= "";
					$error['referee_3']= "";
					$error['referee_4']= "";
				}
				if( $_POST["referee"] == "---" )
				{
					$error['referee']= $text['no_referee'][ $_SESSION['lang']];
				}
				else
					$error['referee']= "";
				// hoste
				if( $_POST["referee2"] == "---" )
				{
					$error['referee2']= $text['no_referee'][ $_SESSION['lang']];
				}
				else
					$error['referee2']= "";
				// hoste
				if( $_POST["referee3"] == "---" )
				{
					$error['referee3']= $text['no_referee'][ $_SESSION['lang']];
				}
				else
					$error['referee3']= "";
				// hoste
				if( $_POST["referee4"] == "---" )
				{
					$error['referee4']= $text['no_referee'][ $_SESSION['lang']];
				}
				else
					$error['referee4']= "";
			// tisk formulare
				if( !$error["date"]=="" || !$error["place"]=="" || !$error["type"]=="" || !$error["score"]==""
					|| !$error["over_time"]=="" || !$error["people"]=="" || !$error["home"]=="" || !$error["guest"]==""
					|| !$error["referee"]==""  || !$error["referee2"]==""  || !$error["referee4"]==""  || !$error["referee3"]==""
					|| !$error["referee_1"]==""  || !$error["list_1"]=="" || !$error["home_1"]=="" )
				{
					writeForm($_POST["date"], $_POST["place"], $_POST["score"], $_POST["over_time"], $_POST["people"]);
				}
				else
				{
					//require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor

					$query=mysql_query("SELECT * FROM `ZAPAS` WHERE DATUM='".$_POST["date"]."' and
																				  MISTO='".$_POST["place"]."';");

					if( mysql_num_rows($query) != 0 )	// zapas je jiz v databazi
					{
					  $error["match"] = $text['no_match'][ $_SESSION['lang']];
					  $_POST["place"] = "";
					  checkForm();
					}
					else	// zapas neni v databazi
					{
						$error["match"] = "";
						$query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee"]."';");
						$row = mysql_fetch_array($query);
						$_POST["referee"] = $row["ID_ROZHODCI"];
						$query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee2"]."';");
						$row = mysql_fetch_array($query);
						$_POST["referee2"] = $row["ID_ROZHODCI"];
						$query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee3"]."';");
						$row = mysql_fetch_array($query);
						$_POST["referee3"]= $row["ID_ROZHODCI"];
						$query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee4"]."';");
						$row = mysql_fetch_array($query);
						$_POST["referee4"]= $row["ID_ROZHODCI"];
						
						if( $_POST["type"]!="skupina" )
						{
							$_POST["group"] = "-";
						}
						$query = mysql_query("INSERT INTO `ZAPAS`
										(DATUM, MISTO, DOMACI, HOSTE, VYSLEDEK, NASTAVENY_CAS, POCET_DIVAKU, TYP_ZAPASU, ROZ_HLAVNI, ROZ_POMEZ1, ROZ_POMEZ2, ROZ_POMOCNY, SOUPISKA1, SOUPISKA2, SKUPINA) VALUES
										('".$_POST["date"]."', '".$_POST["place"]."', '".$_POST["team"]."', '".$_POST["team2"]."', '".$_POST["score"]."', '".$_POST["over_time"]."', '".$_POST["people"]."', '".$_POST["type"]."', '".$_POST["referee"]."', '".$_POST["referee2"]."', '".$_POST["referee3"]."', '".$_POST["referee4"]."', '".$_POST["list"]."', '".$_POST["list2"]."', '".$_POST["group"]."');"
									);
						if( !$query )
						{
							echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." ZAPAS.</h2>";
						}
						else
						{
							echo "<h2>ZAPAS ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
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
