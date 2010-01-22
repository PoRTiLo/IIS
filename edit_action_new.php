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
		include 'default.php';require_once('common.inc');
		global $languageCz;
		global $defaulLanguage;
		$_SESSION['lang']=$defaultLanguage;
		
		session_name('RT_kontext');
		session_start();
		require_once('connect.inc');
         echo "".$text['s_menu'][$_SESSION['lang']].""; 
         echo"
		<div class=\"formular\">
			<form method=post action=\"add_action_new.php\">
			<h2><font color=red>".$text['s_akcedit'][$_SESSION['lang']]."</font></h2>
			<table>
			<tr>
			<td><b>".$text['s_edit'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_id'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_zapas'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_typ'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_hrac'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_minuta'][$_SESSION['lang']]."</b></td>
			</tr>
			";
        
       /* MINUTA, TYP_AKCE, HRAC, ZAPAS */
        
		function showAction() {

			global $languageCz;
			//require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `AKCE`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id, $minute, $type, $player, $match) = mysql_fetch_row($navrat) )
			{
				
				echo"<tr><td>";	      		
				
					echo "<form action='add_action_new.php' method='POST' >
						<input type='hidden' name='id_akce' value=$id>
						<input type='hidden' name='minuta' value=$minute>
						<input type='hidden' name='typ_akce' value=$type>
						<input type='hidden' name='hrac' value=$player>
						<input type='hidden' name='zapas' value=$match>
						<input type='hidden' name='check' value='false'>
						<input type='submit' value='".$languageCz."' name='souhlas'>
					 </form>";
				echo "</td><td>";	 
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
