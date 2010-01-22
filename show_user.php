<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
      <title>RT-Mistroství světa ve fotbalu - zorazení uživatelů</title>
</head>
<body>
	<?php
		/*
		 * Zobrazeni tymu.
		 */

		include 'default.php';

		session_name('RT_kontext');
		session_start();

		function showUser(){

			require_once('connect.inc');
			$navrat=mysql_query("SELECT * FROM `USER`;");
			// do promenych v list se kazdym krokem ceklu nahraje jeden radek cele databaze
			while( list($login, $pass, $name, $surname, $email, $pozicion) = mysql_fetch_row($navrat) )
			{
				echo $login.$pass. $name.$surname. $email.$pozicion."<br>";
			}
		}
		showUser();
	?>
</body>

</html>
