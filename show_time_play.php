<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
      <title>RT-Mistroství světa ve fotbalu - zorazeni odehraných časů hráčů v zápase</title>
</head>
<body>
	<?php
		/*
		 * Zobrazeni tymu.
		 */

		include 'default.php';

		session_name('RT_kontext');
		session_start();

		function showTime(){

			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `ODEHRANY_CAS`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($id, $od, $do_c, $player, $match) = mysql_fetch_row($navrat) )
			{
				echo $id.$od.$do_c.$player.$match."<br>";
			}
		}
		showTime();
	?>
</body>

</html>
