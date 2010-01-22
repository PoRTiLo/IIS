<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
      <title>RT-Mistroství světa ve fotbalu - zorazení doprovodných týmů</title>
</head>
<body>
	<?php
		/*
		 * Zobrazeni doprovodnych tymu.
		 */

		include 'default.php';

		session_name('RT_kontext');
		session_start();

		function showEscort(){
			global $languageCz;
			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `DOPROVODNY_TYM`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id,$name, $surname, $date, $hometown, $street, $city, $zip, $state, $family, $pozicion, $team) = mysql_fetch_row($navrat) )
			{
				echo $id.$name.$surname.$date.$hometown.$street.$city.$zip.$state.$family.$pozicion.$team."<br>";
				echo "<form action='edit_team_escort.php' method='POST' >
						<input type='hidden' name='name' value=$name>
						<input type='hidden' name='surname' value=$surname>
						<input type='hidden' name='pozicion' value=$pozicion>
						<input type='hidden' name='date' value=$date>
						<input type='hidden' name='hometown' value=$hometown>
						<input type='hidden' name='street' value=$street>
						<input type='hidden' name='city' value=$city>
						<input type='hidden' name='zip' value=$zip>
						<input type='hidden' name='state' value=$state>
						<input type='hidden' name='family' value=$family>
						<input type='hidden' name='team' value=$team>
						<input type='hidden' name='check' value='false'>
						<input type='submit' value='".$languageCz."' name='souhlas'>
					 </form>";
			}
		}
		showEscort();
	?>
</body>

</html>
