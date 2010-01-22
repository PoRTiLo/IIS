<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
	<?php
		/*
		 * Zobrazeni akci.
		 */

		include 'default.php';

		session_name('RT_kontext');
		session_start();
		 echo "".$text['s_menu'][$_SESSION['lang']]."";
		 echo"
		<div class=\"formular\">
			<form method=post action=\"add_team.php\">
			<h2><font color=red>".$text['s_actions'][$_SESSION['lang']]."</font></h2>
			<table>
			<tr>
			<td><b>".$text['s_id'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_zapas'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_typ'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_hrac'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_minuta'][$_SESSION['lang']]."</b></td>
			</tr>
			";
		
		function showAction(){

			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `AKCE`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id, $minute, $type, $player, $match) = mysql_fetch_row($navrat) )
			{
				echo"<tr><td>";
				echo $id."</td><td>";        
				echo $match."</td><td>";
				echo $type."</td><td>";
				echo $player."</td><td>";
				echo $minute."</td></tr>";
			}
		}
		showAction();
		echo"
		</table><br>
		</form>
		</div>
		";

	?>
</body>

</html>
