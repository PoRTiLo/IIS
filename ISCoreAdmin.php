<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
<?php
			include 'default.php';
		    global $text;
			global $languageCz;
			global $defaulLanguage;
session_name('RT_kontext');
		session_start();
		    $_SESSION['lang']=$defaultLanguage;
		     
  			echo "".$text['s_menu'][$_SESSION['lang']]."";
?>
</body>

</html>
