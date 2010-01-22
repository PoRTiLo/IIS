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
					//	<tr> <td>".$error['match']."</td> </tr>
// $error[]=array();
//$error["log"]="";
//$error["pass"]="";
function writeForm($log, $pass) {

		global $error;
		global $text;
		echo"
		<div class=\"formular\">
			<form method=post action=\"login.php\">
					<table>
                  <h4><font color=red>K dokončení nasledujicí operace je nutné se prihlásit</font><h4>
				<tr> <td><b>Login: </b> </td> <td><input type='text' name='log' value=\"".$log."\" size='20' maxlength='40' /></td></tr>

						<tr> <td><b>Heslo: </b> </td> <td><input type='password' name='pass' value=\"".$pass."\" size='20' maxlength='40' /></td></tr>
					
					<input type=submit value=Odeslat>
					</table>
			</form>
		</div>
		";
}
/*function checkFormTeam() {

			global $error;
			global $text;
			global $defaultUser;
			global $czechWord;

			if( isset($_POST) )
			{
				writeForm("", "");
			}
			else
			{
			// kontrola nazvu statu
				if( $_POST["log"] == "" )
				{
					$error["log"] = "Heslo nemsi byt prazdne";//$text['no_state1'][ $_SESSION['lang']];
				}
				else
					$error['log']= "";
		// kontrola sloganu
            if( $_POST["pass"]=="")
            {
					$error["pass"] = "Heslo nemsi byt prazdne";//$text['no_state1'][ $_SESSION['lang']];
				}
				else
					$error['pass']= "";
				
					
			// tisk formulare
				if( !$error["log"]=="" || !$error["pass"]=="" )
				{
					writeForm($_POST["log"], "");
				}
            else
            {
                  header( 'Location: login.php'); 
            }
				
				
			}
		}*/
	writeForm("", "");
//checkFormTeam()
?>
</body>

</html>
