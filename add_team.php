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
	$error['code']="";
	$error['state']="";
	$error['slogan']="";
	$error['team']="";
	$error['group']="";


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $files
    * @param <type> $code
    * @param <type> $state
    * @param <type> $slogan
    */
	function writeForm($code, $state, $slogan) {
		global $error;
		global $text;
      global $files;
		echo"
		<div class=\"formular\">
			<form method=post action=".$files["addTeam"].">
					<h2><font color=red>".$error['team']."</font></h2>
					<h2>".$text['add_team'][$_SESSION['lang']]."</h2>
					<table>
						<tr> <td>".$error['code']."</td> </tr>
						<tr> <td><b><font color=red>".$text['t_code'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='code' value=\"".$code."\" size='20' maxlength='40' /></td></tr>
						<tr> <td>".$error['state']."</td> </tr>
						<tr> <td><b><font color=red>".$text['t_state'][$_SESSION['lang']]."</font></b> </td> <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
						<tr> <td>".$error['slogan']."</td> </tr>
						<tr> <td><b>".$text['t_slogan'][$_SESSION['lang']]."</b> </td> <td><input type='textarea' name='slogan' value=\"".$slogan."\" /></td></tr>
						<tr> <td>".$error['group']."</td> </tr>
						<tr> <td><b><font color=red>".$text['t_group'][$_SESSION['lang']]."</font></b></td> <td> "; echo fillDropdownGroup()."</td></tr>
				  </table><br>
					<input type=submit value=Odeslat>
			</form>
		</div>
		";
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
			 writeForm("","","");
		}
		else
		{
         checkCodeM();           //kontrola zkratky statu
         checkNameStateM();      //kontrola nazvu statu
         checkGrooupM();         //kontrola vyberu skupiny
         checkSlogan();          //kontrola sloganu

		// tisk formulare
			if( !$error["code"]=="" || !$error["state"]=="" || !$error["slogan"]==""  || !$error["group"]=="" )
			{
				writeForm($_POST["code"], $_POST["state"], $_POST["slogan"]);
			}
			else
			{
				$query=mysql_query("SELECT * FROM `TYM` WHERE KOD_ZEME='".$_POST["code"]."';");

				if( mysql_num_rows($query) != 0 )	// tym je jiz v databazi
				{
				  $error["team"] = $text['no_team_add'][ $_SESSION['lang']];
				  $_POST["code"] = "";
				  checkForm();
				}
				else	// tym neni v databazi
				{
					$query=mysql_query("SELECT * FROM `TYM` WHERE SKUPINA='".$_POST["group"]."';");
					if( mysql_num_rows($query) == 4 )
					{
						$_POST["code"] = "";
						$error["team"] = $_POST["group"] .$text['no_team_add1'][ $_SESSION['lang']];
						checkForm();
					}
					else
					{
						$query = mysql_query("INSERT INTO `TYM` (KOD_ZEME, ZEME, SKUPINA, SLOGAN) VALUES
										('".strtoupper($_POST["code"])."', '".$_POST["state"]."', '".$_POST["group"]."', '".$_POST["slogan"]."');"
									);
						if( !$query )
						{
							echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
						}
						else
						{
							echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
						}
						$query=mysql_query("SELECT TYM_1 FROM `SKUPINA` WHERE `TYM_1` is null && `JMENO`='".$_POST["group"]."' ;" );
						if( mysql_num_rows($query) != 0 )
						{
							$query = mysql_query("UPDATE `SKUPINA` SET `TYM_1`= '".strtoupper($_POST["code"])."' WHERE `SKUPINA`.`JMENO` ='".$_POST["group"]."';") ;
							if( $query )
							{
								echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
							}
							else
							{
								echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
							}
						}
						else
						{
							$query=mysql_query("SELECT `TYM_2` FROM `SKUPINA` WHERE JMENO='".$_POST["group"]."'and TYM_2 is null;" );
							if( mysql_num_rows($query) != 0 )
							{
								$query = mysql_query("UPDATE `SKUPINA` SET `TYM_2`= '".strtoupper($_POST["code"])."' WHERE `SKUPINA`.`JMENO` ='".$_POST["group"]."';") ;
								if( $query )
								{
									echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
								}
								else
								{
									echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
								}
							}
							else
							{
								$query=mysql_query("SELECT `TYM_3` FROM `SKUPINA` WHERE JMENO='".$_POST["group"]."'and TYM_3 is null;" );
								if( mysql_num_rows($query) != 0 )
								{
									$query = mysql_query("UPDATE `SKUPINA` SET `TYM_3`= '".strtoupper($_POST["code"])."' WHERE `SKUPINA`.`JMENO` ='".$_POST["group"]."';") ;
									if( $query )
									{
										echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
									}
									else
									{
										echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
									}
								}
								else
								{
									$query=mysql_query("SELECT `TYM_4` FROM `SKUPINA` WHERE JMENO='".$_POST["group"]."'and TYM_4 is null;" );
									if( mysql_num_rows($query) != 0 )
									{
										$query = mysql_query("UPDATE `SKUPINA` SET `TYM_4`= '".strtoupper($_POST["code"])."' WHERE `SKUPINA`.`JMENO` ='".$_POST["group"]."' ;") ;
										if( $query )
										{
											echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
										}
										else
										{
											echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
										}
									}
									else
									{
										echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
									}
								}
							}
						}
						echo mysql_error();
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
