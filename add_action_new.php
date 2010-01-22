<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
<body>
	<?php
	/*
	 * Pridani noveho tymu, ktery jeste neni v databazi.
	 * Po vybrani spravne tabulky se prida i do ni.
	 *
	 */

	//header("Content-Type: text/html; charset=iso-8859-2");
	include 'default.php';
	require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor
   require_once('common.inc');
	session_name('RT_kontext');
	session_start();

	$_SESSION['lang'] = 0;
	$error[]=array();
	$error['action']="";
	$error['minute']="";
	$error['type']="";
	$error['player']="";
	$error['match']="";

	/**
	 *	Vypise formular
	 * @global <type> $error
	 * @global <type> $text
	 * @param <type> $code
	 * @param <type> $state
	 * @param <type> $slogan
	 */
	global $error;
	global $text;
	global $languageCz;
	 echo "".$text['s_menu'][$_SESSION['lang']]."";
	function writeForm($minute) {

		global $error;
		global $text;
		echo"
		<div class=\"formular\">
			<form method=post action=\"add_action_new.php\">
					<h2><font color=red>".$error['action']."</font></h2>
					<h2>".$text['add_action'][$_SESSION['lang']]."</h2>
					<table>
						<tr> <td>".$error['match']."</td> </tr>
						<tr> <td><b><font color=red>".$text['f_match'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownAction()."</td></tr>
						<tr> <td>".$error['minute']."</td> </tr>
						<tr> <td><b><font color=red>".$text['f_minute'][$_SESSION['lang']]."</font></b> </td> <td><input type='text' name='minute' value=\"".$minute."\" size='20' maxlength='40' /></td></tr>
						<tr> <td>".$error['action']."</td> </tr>
						<tr> <td><b><font color=red>".$text['f_match_type'][$_SESSION['lang']]."</font></b></td> <td> "; echo callDropdownActionType()."</td></tr>
						<tr> <td>".$error['player']."</td> </tr>
						<tr> <td><b><font color=red>".$text['f_player'][$_SESSION['lang']]."</font></b></td> <td> "; echo fillDropdownActionPlayer()."</td></tr>
				  </table><br>
					<input type=submit value=Odeslat>
			</form>
		</div>
		";

	}


	function callDropdownActionType() {

		global $text;
		global $defaultLanguage;

		$pairs[$text['f_y_card'][$defaultLanguage]] = $text['f_y_card'][$defaultLanguage];
		$pairs[$text['f_r_card'][$defaultLanguage]] = $text['f_r_card'][$defaultLanguage];
		$pairs[$text['f_foul'][$defaultLanguage]] = $text['f_foul'][$defaultLanguage];
		$pairs[$text['f_goal'][$defaultLanguage]] = $text['f_goal'][$defaultLanguage];
		$pairs[$text['f_own_goal'][$defaultLanguage]] =$text['f_own_goal'][$defaultLanguage];
		$pairs[$text['f_corner'][$defaultLanguage]] = $text['f_corner'][$defaultLanguage];
		$pairs[$text['f_offside'][$defaultLanguage]] =$text['f_offside'][$defaultLanguage];
		$pairs[$text['f_out'][$defaultLanguage]] = $text['f_out'][$defaultLanguage];
		$pairs[$text['f_penalty'][$defaultLanguage]] =$text['f_penalty'][$defaultLanguage];

		if( empty($_POST))
				echo createDropdown("type", $pairs, "---", "---");
			else
				echo createDropdown("type", $pairs, "---", $_POST["type"]);
	}

	/**
	 * Zkontrolu vlozena data
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
			 writeForm("");
		}
		else
		{
		// kontrola zkratky statu
			if( $_POST["minute"] == "" )
			{
				$error["minute"] = $text['no_minute'][ $_SESSION['lang']];
			}
			//else if( !ereg("^([0-9]{0,1})$", $_POST["minute"])) ///jen cisla
			//{
			//	$error["minute"] = $text['no_minute2'][ $_SESSION['lang']];
			//}
			else if( $_POST["minute"] > 120 )
			{
				$error["minute"] = $text['no_minute3'][ $_SESSION['lang']];
			}
			else
				$error['minute']= "";

			if( $_POST["match"] == "---" )
			{
				$error["match"] = $text['no_team5'][ $_SESSION['lang']];
			}
			else
			{
				$error['match']= "";
			}
			if( $_POST["type"] == "---" )
			{
				$error["action"] = $text['no_action'][ $_SESSION['lang']];
			}
			else
			{
				$error['action']= "";
			}
			if( $_POST["player"] == "---" )
			{
				$error["player"] = $text['no_player'][ $_SESSION['lang']];
			}
			else
			{
				$error['player']= "";
			}
		// tisk formulare
			if( !$error["minute"]=="" || !$error["player"]=="" || !$error["action"]==""  || !$error["match"]=="" )
			{
				writeForm($_POST["minute"]);
			}
			else
			{
				//$query=mysql_query("SELECT * FROM `HRAC` WHERE PRIJMENI='".$_POST["minute"]."' AND HRAC='".$_POST["player"]."' AND HRAC='".$_POST["action"]."';");
				$pom1 = substr($_POST['match'], 0,3);
				$pom2 = substr($_POST['match'], 4,7);

				/*$query = mysql_query("SELECT ID_HRAC FROM `HRAC` where PRIJMENI='".$_POST['player']."'AND (TYM='".$pom1."' OR  TYM='".$pom2."');");
				if( mysql_num_rows($query) == 0 )	// tym je jiz v databazi
				{	echo mysql_error();
					echo"chybaaaaaaaaaaaaaaaaaaaaaaaaa";
					$_POST['player']=="---";
					$_POST['minute']=="";
				  $error["action"] = $text['no_team_add'][ $_SESSION['lang']];
				  checkForm();
				}*/
				//$row = mysql_fetch_array($query);
				$_POST['player']=0;//$row["ID_HRAC"];
				
				$query=mysql_query("SELECT * FROM `AKCE` WHERE MINUTA='".$_POST["minute"]."' AND HRAC='".$_POST["player"]."' AND TYP_AKCE='".$_POST["type"]."';");

				if( mysql_num_rows($query) != 0 )	// tym je jiz v databazi
				{
				  $error["action"] = $text['no_team_add'][ $_SESSION['lang']];
				  checkForm();
				}
				else	// tym neni v databazi
				{
					$query = mysql_query("SELECT ID_ZAPAS FROM `ZAPAS` where DOMACI='".$pom1."' AND  HOSTE='".$pom2."';");
					$row = mysql_fetch_array($query);
					echo mysql_error();
					$_POST['match']=$row["ID_ZAPAS"];

					$query = mysql_query("INSERT INTO `AKCE` (MINUTA, TYP_AKCE, HRAC, ZAPAS) VALUES
									('".$_POST["minute"]."', '".$_POST["type"]."', '".$_POST["player"]."', '".$_POST["match"]."');");
					if( !$query )
					{
						echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." AKCE.</h2>";
					}
					else
					{
						echo "<h2>AKCE ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
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
