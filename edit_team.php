<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
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
		$error['code']="";
		$error['state']="";
		$error['slogan']="";
		$error['team']="";
		$error['group']="";

		/**
		 *
		 * @global <type> $error
		 * @global <type> $text
		 * @param <type> $code
		 * @param <type> $state
		 * @param <type> $group
		 * @param <type> $slogan
		 */
		 echo "".$text['s_menu'][$_SESSION['lang']].""; 
		function writeFormTeam($code, $state, $group, $slogan) {

			global $error;
			global $text;
			echo"
			<div class=\"formular\">
				<form method=post action=\"edit_team.php\">
						<h2><font color=red>".$error['team']."</font></h2>
						<h2>".$text['add_team'][$_SESSION['lang']]."</h2>
						<table>
							<tr> <td>".$error['code']."</td> </tr>
							<tr> <td><b>".$text['t_code'][$_SESSION['lang']]."</b></td> <td><input type='text' readonly name='code' value=\"".$code."\" size='20' maxlength='40' /></td></tr>
							<tr> <td>".$error['state']."</td> </tr>
							<tr> <td><b><font color=red>".$text['t_state'][$_SESSION['lang']]."</font></b> </td> <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
							<tr> <td>".$error['slogan']."</td> </tr>
							<tr> <td><b>".$text['t_slogan'][$_SESSION['lang']]."</b> </td> <td><input type='textarea' name='slogan' value=\"".$slogan."\" /></td></tr>
							<tr> <td>".$error['group']."</td> </tr>
							<tr> <td><b>".$text['t_group'][$_SESSION['lang']]."</b></td> <td><input type='text' readonly name='group' value=\"".$group."\" size='20' maxlength='40' /></td></tr>
					  </table><br>
						<input type='hidden' name='check' value='true'>
						<input type=submit value=Odeslat>
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
		function checkFormTeam() {

			global $error;
			global $text;
			global $defaultUser;
			global $czechWord;

			if( $_POST["check"]=='false' )
			{
				editTeam();
			}
			else
			{
			// kontrola nazvu statu
				if( $_POST["state"] == "" )
				{
					$error["state"] = $text['no_state1'][ $_SESSION['lang']];
				}
				elseif( strlen($_POST["state"]) > 25 )
				{
					$error["state"] = $text['no_state2'][ $_SESSION['lang']];
				}
				else
					$error['state']= "";
		// kontrola sloganu
				if( strlen($_POST["slogan"]) > 150 )
				{
					$error["slogan"] = $text['no_slogan'][ $_SESSION['lang']];
				}
				else
					$error['slogan']= "";
			// tisk formulare
				if( !$error["state"]=="" || !$error["slogan"]=="" )
				{
					writeFormTeam($_POST["code"], $_POST["state"], $_POST["group"], $_POST["slogan"]);
				}
				else
				{
					$quastion = "UPDATE `TYM` SET `ZEME`='".$_POST["state"]."', `SLOGAN`='".$_POST["slogan"]."' WHERE `KOD_ZEME`='".$_POST["code"]."';";

					$query = mysql_query($quastion);
					if( !$query )
					{
						echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
					}
					else
					{
						echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}
				}
			}
		}

		function editTeam() {

			$edit_team[]=array();

			$edit_team["code"]=strtoupper($_POST["code"]);
			$query=mysql_query("SELECT * FROM `TYM` WHERE KOD_ZEME='".$edit_team["code"]."';");

			if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
			{
				echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
			}
			else
			{
				$row = mysql_fetch_array($query);

				$edit_team["state"]=$row["ZEME"];
				$edit_team["group"]=$row["SKUPINA"];
				$edit_team["slogan"]=$row["SLOGAN"];
			}
			writeFormTeam($edit_team["code"], $edit_team["state"],$edit_team["group"],$edit_team["slogan"]);
		}
		if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
		{
			if ($_SESSION["access_time"] < strtotime(A_LOG_TIME))
			{
				require_once('automatic_loggout.php');
				exit();
			}
			$_SESSION["access_time"] = time();
			checkFormTeam();
		}
		else
		{
			header( 'Location: enter.php'); 
		}
		

		?>
	</body>
</html>
