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
session_start();require_once('common.inc');
global $defaultLanguage;
$_SESSION['lang']=$defaultLanguage;	
echo "".$text['s_menu'][$_SESSION['lang']]."";

function writeForm() {

		global $error;
		global $text;
	    echo"
		<div class=\"formular\">
			<form method=post action=\"automatic_logout.php\">
					<table>
                  <h1><font color=red>Automaticky odhlásen</font><h1>
                  <tr><td><a href="index.html">Prosim pokracujte</a></td></tr>
					</table>
			</form>
		</div>
		";
}

writeForm();

?>
</body>

</html>