<?php

	include 'default.php';
   $file = $files["connect"];
   require_once ("$file");
   $file = $files['common'];
   require_once ("$file");

	session_name('RT_kontext');
	session_start();

	$_SESSION['lang'] = 0;

	$error[]=array();
	$error['action']="";
	$error['minute']="";
	$error['type']="";
	$error['player']="";
	$error['match']="";

   global $error;
	global $text;
	global $languageCz;


	/**
    *
    * @global <type> $error
    * @global <type> $text
    * @param <type> $minute
    */
	function writeForm($minute) {
		global $error;
		global $text;
      global $files;
		echo"
		<div class=\"formular\">
			<form method=post action=".$files["addAction"].">
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


   /**
    *
    * @global <type> $text
    * @global <type> $defaultLanguage
    */
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
    *
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
         checkMinuteM();
         checkMatchM();             //kontrola zkratky statu
         checkTypeActionM();
         checkPlayerM();

		// tisk formulare
			if( !$error["minute"]=="" || !$error["player"]=="" || !$error["action"]==""  || !$error["match"]=="" )
			{
				writeForm($_POST["minute"]);
			}
			else
			{
				$pom1 = substr($_POST['match'], 0,3);
				$pom2 = substr($_POST['match'], 4,7);

				$_POST['player'] = 0;

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

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   $file = $files['rule'];
   require_once ("$file");

?>