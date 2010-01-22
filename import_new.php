<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
<link rel="stylesheet" href="styles.css" type="text/css">
<title>Informacny system</title>
</head>
<body>
<?php
/*
 * TODO: nejde nejspis kodovani
 *			dodeta auto+increment v pridavani tabulky
 */
    include 'default.php';
    global $languageCz;
	global $defaultLanguage;
	global $text;
require_once('common.inc');
session_name('RT_kontext');
session_start();
	$_SESSION['lang']=$defaultLanguage;
	echo "".$text['s_menu'][$_SESSION['lang']]."";
	echo "<div class=\"formular\">
			<form method=post action=\"\">
			<table>";

	/*$xml_data[] = array();
	$xml_data['Db_id'] = "";
	$xml_data['Db_name'] = "";
	$xml_data['Db_surname'] = "";
	$xml_data['Db_date'] = "";
	$xml_data['Db_home_club'] = "";
	$xml_data['Db_last_club'] = "";
	$xml_data['Db_hometown'] = "";
	$xml_data['Db_street'] = "";
	$xml_data['Db_city'] = "";
	$xml_data['Db_team'] = "";
	$xml_data['Db_family'] = "";
	$xml_data['Db_state'] = "";
	$xml_data['Db_pozicion'] = "";
*/

$Db_id = "";
$Db_zip = "";
	$Db_name = "";
	$Db_surname = "";
	$Db_date = "";
	$Db_home_club = "";
	$Db_last_club = "";
	$Db_hometown = "";
	$Db_street = "";
	$Db_city = "";
	$Db_team= "";
	$Db_family = "";
	$Db_state = "";
	$Db_pozicion = "";

	/**
	 *
	 * @global <type> $activ
	 * @param <type> $parser
	 * @param <type> $term
	 * @param <type> $attribute 
	 */
	function firstSymbol($parser, $term, $attribute) {

		global $activ;
		$activ=StrToUpper($term);	// nazvy sloupcu prevest na velak pismena
	}

	/**
	 *
	 * @global <type> $activ
	 * @param <type> $parser
	 * @param <type> $term
	 */
	function lastSymbol($parser, $term) {

		global $activ;
		$activ='';
	}

	/**
	 *
	 * @global <type> $xml_data
	 */
	function insertIntoDb() {
	global	$Db_id;
	global $Db_name;// = "";
global	$Db_surname;// = "";
global	$Db_date;// = "";
global	$Db_home_club;// = "";
global	$Db_last_club;// = "";
global	$Db_hometown;// = "";
global	$Db_street;// = "";
global	$Db_city;// = "";
global	$Db_team;//= "";
global	$Db_family;// = "";
global	$Db_state;// = "";
global	$Db_pozicion;// = "";
global	$Db_zip;// = "";

		//$query = mysql_query("SELECT * FROM `HRAC` WHERE `JMENO`='".$xml_data['Db_name']."' and `PRIJMENI`='".$xml_data['Db_surname']."' and `TYM`='".$xml_data['Db_team']."';");
		$query = mysql_query("SELECT * FROM `HRAC` WHERE `JMENO`='".$Db_name."' and `PRIJMENI`='".$Db_surname."' and `TYM`='".$Db_team."';");
		if( mysql_num_rows($query) == 0 ) // zaady hrac jeste neni v databazi
		{

			//$kv = array();
			//foreach( $xml_data as $key => $value )
			//{
			//	$kv[] = "$key=$value";
			//}
			//$query_string = join("&", $kv);
			//echo $query_string;

	//		$query = mysql_query("INSERT INTO `HRAC` (ID_HRAC, JMENO, PRIJMENI, HRACI_POZICE, DATUM_NAROZENI, DOMOVSKY_KLUB, RODISTE, BYVALY_KLUB, ULICE, MESTO, ZIP, STAT, RODINNY_STAV, TYM) VALUES
//			('".$xml_data['Db_id']."', '".$xml_data['Db_name']."', '".$xml_data['Db_surname']."', '".$xml_data['Db_pozicion']."', '".$xml_data['Db_date']."'), '".$xml_data['Db_home_club']."', '".$xml_data['Db_hometown']."', '".$xml_data['Db_last_club']."',
//			 '".$xml_data['Db_street']."', '".$xml_data['Db_city']."', '".$xml_data['Db_zip']."', '".$xml_data['Db_state']."', '".$xml_data['Db_family']."', '".$xml_data['Db_team']."';");

			$query = mysql_query("INSERT INTO `HRAC` (ID_HRAC, JMENO, PRIJMENI, HRACI_POZICE, DATUM_NAROZENI, DOMOVSKY_KLUB, RODISTE, BYVALY_KLUB, ULICE, MESTO, ZIP, STAT, RODINNY_STAV, TYM) VALUES
			('".$Db_id."', '".$Db_name."', '".$Db_surname."', '".$Db_pozicion."', '".$Db_date."'), '".$Db_home_club."', '".$Db_hometown."', '".$Db_last_club."',
			 '".$Db_street."', '".$Db_city."', '".$Db_zip."', '".$Db_state."', '".$Db_family."', '".$Db_team."';");
			if( !$query )
			{
				echo"<tr><td>nepovedelo se zapsat do tabulky</td></tr>";
				mysql_error();echo"<tr><td></td></tr>";
			}
		/*	$xml_data['Db_id'] = "";
			$xml_data['Db_name'] = "";
			$xml_data['Db_surname'] = "";
			$xml_data['Db_date'] = "";
			$xml_data['Db_home_club'] = "";
			$xml_data['Db_last_club'] = "";
			$xml_data['Db_hometown'] = "";
			$xml_data['Db_street'] = "";
			$xml_data['Db_city'] = "";
			$xml_data['Db_team'] = "";
			$xml_data['Db_family'] = "";
			$xml_data['Db_state'] = "";
			$xml_data['Db_pozicion'] = "";*/
			$Db_id = "";
	$Db_name = "";
	$Db_surname = "";
	$Db_date = "";
	$Db_home_club = "";
	$Db_last_club = "";
	$Db_hometown = "";
	$Db_street = "";
	$Db_city = "";
	$Db_team= "";
	$Db_family = "";
	$Db_state = "";
	$Db_pozicion = "";
	$Db_zip = "";
		}
		else
		{
			echo "<tr><td>Hrac se jmenem ".$Db_name." a prijmenim ".$Db_surname.", hrajici za stat ".$Db_team."jiz existuje".$Dlogin.".Import ignorován.</td></tr>";
		}
	}

	/**
	 *
	 * @global <type> $activ
	 * @global <type> $xml_data
	 * @param <type> $parser
	 * @param <type> $data
	 */
	function symbol($parser, $data) {

		global $activ;
		//global $xml_data;
		global	$Db_id;
	global $Db_name;// = "";
global	$Db_surname;// = "";
global	$Db_date;// = "";
global	$Db_home_club;// = "";
global	$Db_last_club;// = "";
global	$Db_hometown;// = "";
global	$Db_street;// = "";
global	$Db_city;// = "";
global	$Db_team;//= "";
global	$Db_family;// = "";
global	$Db_state;// = "";
global	$Db_pozicion;// = "";
global	$Db_zip;// = "";
		echo "<tr><td>...".$activ."...</td></tr>";
		switch($activ)
		{
			case "ID_HRAC":
				//$xml_data['Db_id'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_id = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "JMENO":
				//$xml_data['Db_name'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_name = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "PRIJMENI":
				//$xml_data['Db_surname'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_surname = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "HRACI_POZICE":
				//$xml_data['Db_pozicion'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_pozicion = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				//echo"<br><br>".$xml_data['Db_pozicion']."<br><br>";
				echo"<tr><td>".$Db_pozicion."</td></tr>";
				break;
			case "DATUM_NAROZENI":
				//$xml_data['Db_date'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$xDb_date = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "DOMOVSKY_KLUB":
				//$xml_data['Db_home_club'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_home_club = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "RODISTE":
				//$xml_data['Db_hometown'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_hometown = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "BYVALY_KLUB":
				//$xml_data['Db_last_club'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_last_club = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "ULICE":
				//$xml_data['Db_street'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_street = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "MESTO":
				//$xml_data['Db_city'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_city = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "ZIP":
				//$xml_data['Db_zip'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_zip = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "STAT":
				//$xml_data['Db_state'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_state = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				break;
			case "RODINNY_STAV":
				//$xml_data['Db_family'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_family = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				echo"<tr><td>".$Db_family."</td></tr>";
				break;
			case "TYM":
				//$xml_data['Db_team'] = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				$Db_team = mb_convert_encoding($data,"ISO-8859-2","UTF-8");
				insertIntoDb();
				
				break;
		}
	}

function import() {

	require_once('connect.inc');

	if( isset($_POST["up"]) )
	{
		if( !move_uploaded_file ($_FILES['soubor']['tmp_name'], "./upload.xml") )	// nepovedlo se nahrat soubor na server
		{
			echo "<tr><td>Nepovedlo se nahart soubor na server</td></tr>";
		}
		else
		{
			$our_file = "upload.xml";

			$parser = xml_parser_create("UTF-8"); //vytvoreni XML parsru

      xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING,"UTF-8");
      xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
      xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
			if( !$parser )	// pri chybe vraci FALSE
			{
				echo"<tr><td>Nepovedlo se vytvorit parser</td></tr>";
			}
			else
			{
				$correct = xml_set_element_handler($parser, "firstSymbol", "lastSymbol");
				if( !$correct )
					die("CHYBA:xml_set_element_handler");

				$correct = xml_set_character_data_handler($parser, "symbol");
				if( !$correct )
					die("CHYBA:xml_set_character_data_handler");

				$file_data = fopen($our_file, "r");
				if( !$file_data )
				{
					die("Nelze otevřít soubor data.xml!");
				}
				else
				{
					$query=mysql_query("TRUNCATE TABLE `HRAC`;");
					if( !$query )
					{
						echo "<tr><td>Nepovedlo se vyprázdnit tabulku student</td></tr>";
						exit();
					}
					while( $data = fread($file_data, 100) )
					{
						if( !xml_parse($parser, $data, feof($file_data)) )
						{
							die("Chyba XML");
						}

					}
					xml_parser_free($parser);
				}
			}
		}
	}
	else
	{
		echo "<h2><font color=red>Import hracu</font></h2>
        <tr><td>Vyberte soubor s importovanými daty:</td></tr>";

		echo "<tr><td><FORM ACTION='' METHOD='post' ENCTYPE='multipart/form-data'>
					<INPUT TYPE='file' NAME='soubor' SIZE='30'>
					<input type='hidden' name='up' value=''>
					<INPUT TYPE='submit' NAME='akce' VALUE='Upload'>
					</FORM></td></tr>
		";
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
		import();
	}
	else
   {
      header('Location: enter.php');
	}
	echo"</table></div>";
?>

</body>

</html>
