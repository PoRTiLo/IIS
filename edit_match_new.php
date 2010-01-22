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
require_once('common.inc');
		session_name('RT_kontext');
		session_start();
		
       	global $languageCz;
		global $defaulLanguage;
		$_SESSION['lang']=$defaultLanguage;	
		
		
		
        echo "".$text['s_menu'][$_SESSION['lang']].""; 
        echo "<div class=\"formular\">
			<form method=post action=\"add_match_new.php\">
			<h2><font color=red>".$text['s_zapedit'][$_SESSION['lang']]."</font></h2>
			<table>
			<tr>
			<td><b>".$text['s_edit'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_date'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_skupina'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_home'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_guest'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_score'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_type'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_time'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_people'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_ref1'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_ref2'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_ref3'][$_SESSION['lang']]."</b></td>
			<td><b>".$text['s_ref4'][$_SESSION['lang']]."</b></td>
			</tr>
			";
        
		function showMatch(){
			global $languageCz;
			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `ZAPAS`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id, $date, $place, $home, $guest, $score, $time, $people, $type, $referee1, $referee2, $referee3, $referee4, $list1, $list2, $group) = mysql_fetch_row($navrat) )
			{
						$query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee1."';");
						$row = mysql_fetch_array($query);
						$referee1 = $row["PRIJMENI"];
						$query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee2."';");
						$row = mysql_fetch_array($query);
						$referee2 = $row["PRIJMENI"];
						$query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee3."';");
						$row = mysql_fetch_array($query);
						$referee3 = $row["PRIJMENI"];
						$query=mysql_query("SELECT PRIJMENI, JMENO FROM `ROZHODCI` WHERE `ID_ROZHODCI`='".$referee4."';");
						$row = mysql_fetch_array($query);
						$referee4 = $row["PRIJMENI"];
						
				echo"<tr><td>";
				echo "<form action='add_match_new.php' method='POST' >
						<input type='hidden' name='id' value=$id>
						<input type='hidden' name='date' value=$date>
						<input type='hidden' name='place' value=$place>
						<input type='hidden' name='home' value=$home>
						<input type='hidden' name='guest' value=$guest>
						<input type='hidden' name='score' value=$score>
						<input type='hidden' name='time' value=$time>
						<input type='hidden' name='people' value=$people>
						<input type='hidden' name='type' value=$type>
						<input type='hidden' name='referee1' value=$referee1>
						<input type='hidden' name='referee2' value=$referee2>
						<input type='hidden' name='referee3' value=$referee3>
						<input type='hidden' name='referee4' value=$referee4>
						<input type='hidden' name='check' value='false'>
						<input type='submit' value='".$languageCz."' name='souhlas'>
					 </form>";
				echo "</td><td>";	 

			    echo $date."</td><td>";        
				echo $group."</td><td>";
				echo $home."</td><td>";
				echo $guest."</td><td>";
				echo $score."</td><td>";
				echo $type."</td><td>";
				echo $time."</td><td>";
				echo $people."</td><td>";
				echo $referee1."</td><td>";
	
				echo $referee2."</td><td>";
			
				echo $referee3."</td><td>";
				
				echo $referee4."</td></tr>";
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
			showMatch();
		}
		else
		{
         header('Location: enter.php');
      }
		
		echo"
		</table><br>
		</form>
		</div>
		";
	?>
</body>

</html>
