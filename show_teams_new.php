<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>

	<?php
		/*
		 * Zobrazeni tymu.
		 */
          
		include 'default.php';

		session_name('RT_kontext');
		session_start();

      global $defaultLanguage;
      $_SESSION['lang']=$defaultLanguage; 
      
		echo "".$text['s_menu'][$_SESSION['lang']]."";        
        echo"
		<div class=\"formular\">
			<form method=post action=\"add_team.php\">
			<h2><font color=red>".$text['s_teams'][$_SESSION['lang']]."</font></h2>
			<table>
			<tr>
			<td><b>".$text['s_code'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_stat'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_skupina'][$_SESSION['lang']]."</b></td>
			</tr>
			";

        
		function showTeam(){

			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `TYM`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($code, $state, $group, $slogan) = mysql_fetch_row($navrat) )
			{
				echo"<tr><td>";        
				echo $code."</td><td>";
				echo $state."</td><td>";
				echo $group."</td><tr>";
			}
		}
		showTeam();
		echo"
		</table><br>
		</form>
		</div>
		";

		
	?>
</body>

</html>
