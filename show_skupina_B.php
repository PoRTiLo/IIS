<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
	<?php
		include 'default.php';

		session_name('RT_kontext');
		session_start();
      $_SESSION['lang'] = 0;
		/*
		 * Zobrazeni tymu.
		 */
		 echo "".$text['s_menu'][$_SESSION['lang']].""; 
		  echo"
		<div class=\"formular\">
			<form method=post action=\"add_team.php\">
			<h2><font color=red>".$text['s_skB'][$_SESSION['lang']]."</font></h2>
			<table>
			";
		function showGroups(){

         global $text;
			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `SKUPINA` WHERE JMENO='B';");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($name, $city, $team_1, $team_2, $team_3, $team_4) = mysql_fetch_row($navrat) )
			{
				echo"<tr><td><b>".$text['s_mesto'][$_SESSION['lang']]."</b></td><td>";
				echo $city."</td></tr>";
				
                echo"<tr><td><b>".$text['s_tym1'][$_SESSION['lang']]."</b></td><td>";
				echo $team_1."</td></tr>";
				
				echo"<tr><td><b>".$text['s_tym2'][$_SESSION['lang']]."</b></td><td>";
				echo $team_2."</td></tr>";
				
				echo"<tr><td><b>".$text['s_tym3'][$_SESSION['lang']]."</b></td><td>";
				echo $team_3."</td></tr>";
				
				echo"<tr><td><b>".$text['s_tym4'][$_SESSION['lang']]."</b></td><td>";
				echo $team_4."</td></tr>";
			}
		}
		showGroups();
		echo"
		</table><br>
		</form>
		</div>
		";

	?>
</body>

</html>
