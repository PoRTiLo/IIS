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
			<form method=post action=\"edit_escort.php\">
			<h2><font color=red>".$text['s_dopshow'][$_SESSION['lang']]."</font></h2>
			<table>
			<tr>
			<td><b>".$text['s_meno'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_priezv'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_stat'][$_SESSION['lang']]."</b></td>
			</tr>
			";
        
        
		function showEscort() {

			global $languageCz;
			//require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `DOPROVODNY_TYM`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id, $name, $surname, $date, $hometown, $street, $city, $zip, $state) = mysql_fetch_row($navrat) )
			{
				
				echo"<tr><td>";	      			 
			    echo $name."</td><td>";        
				echo $surname."</td><td>";
				echo $state."</td></tr>";		 
		   }			 
		  	
		}
		showEscort();
		echo"
		</table><br>
		</form>
		</div>
		";
		 
	?>
</body>

</html>