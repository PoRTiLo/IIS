<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
	<?php
		/*
		 * Zobrazeni hracu.
		 */

		//header("Content-Type: text/html; charset=iso-8859-2");
		include 'default.php';
		global $languageCz;
		global $defaulLanguage;
		$_SESSION['lang']=$defaultLanguage;
		
		session_name('RT_kontext');
		session_start();
		require_once('connect.inc');
         echo "".$text['s_menu'][$_SESSION['lang']].""; 
         echo"
		<div class=\"formular\">
			<form method=post action=\"add_team.php\">
			<h2><font color=red>".$text['s_hraci'][$_SESSION['lang']]."</font></h2>
			<table>
			<tr>
			<td><b>".$text['s_meno'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_priezv'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_pozicia'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_domklub'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_stat'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_team'][$_SESSION['lang']]."</b></td>
			</tr>
			";
        
        
		function showPlayer() {

			global $languageCz;
			//require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `HRAC`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id,$name, $surname, $pozicion, $date, $home_club, $hometown, $last_club, $street, $city, $zip, $state, $family, $team) = mysql_fetch_row($navrat) )
			{
				
				echo"<tr><td>";
				echo $name."</td><td>";        
				echo $surname."</td><td>";
				echo $pozicion."</td><td>";
				echo $home_club."</td><td>";
				echo $state."</td><td>";
				echo $team."</td></tr>";	      		
			}
		}
		showPlayer();
		echo"
		</table><br>
		</form>
		</div>
		";
		 
	?>
</body>

</html>
