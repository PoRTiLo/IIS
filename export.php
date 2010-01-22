<?php

	include 'default.php';
	session_name('RT_kontext');
	session_start();
   $file = $files["connect"];
   require_once ("$file");
   $file = $files['common'];
   require_once ("$file");

   require_once('show_head.php');
   require_once('head.php');

   global $languageCz;
	global $defaultLanguage;
	global $text;
	$_SESSION['lang']=$defaultLanguage;
	echo "<div class=\"formular\">
			<form method=post action=\"\">
			<table>";


   /**
    *
    */
	function writeXML() {
		$data ="";
		$query = mysql_query( "SELECT * FROM `DOPROVODNY_TYM`;" );
		if( !$query )
		{
			echo"<tr></td>nepovedlo se vytvorit data.xml</td></tr>";
		}
		else
		{
			$fp = FOpen ("data.xml", "w");	// otevreni souboru
			$data .= "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
			$data .= "<DOPROVODNE_TYMY>\n";
			while( $row = mysql_fetch_array($query) )
			{
				$data .= "\t<DOPROVODNY_TYM>\n";

					$data .= "\t\t<ID_DOPROVODNY_TYM>";
					$data .= mb_convert_encoding($row["ID_DOPROVODNY_TYM"], "UTF-8", "ISO-8859-2");
					$data .= "</ID_DOPROVODNY_TYM>\n";

					$data .= "\t\t<JMENO>";
					$data .= mb_convert_encoding($row["JMENO"], "UTF-8", "ISO-8859-2");
					$data .= "</JMENO>\n";

					$data .= "\t\t<PRIJMENI>";
					$data .= mb_convert_encoding($row["PRIJMENI"], "UTF-8", "ISO-8859-2");
					$data .= "</PRIJMENI>\n";

					$data .= "\t\t<DATUM_NAROZENI>";
					$data .= mb_convert_encoding($row["DATUM_NAROZENI"], "UTF-8", "ISO-8859-2");
					$data .= "</DATUM_NAROZENI>\n";

					$data .= "\t\t<RODISTE>";
					$data .= mb_convert_encoding($row["RODISTE"], "UTF-8", "ISO-8859-2");
					$data .= "</RODISTE>\n";

					$data .= "\t\t<ULICE>";
					$data .= mb_convert_encoding($row["ULICE"], "UTF-8", "ISO-8859-2");
					$data .= "</ULICE>\n";

					$data .= "\t\t<MESTO>";
					$data .= mb_convert_encoding($row["MESTO"], "UTF-8", "ISO-8859-2");
					$data .= "</MESTO>\n";

					$data .= "\t\t<ZIP>";
					$data .= mb_convert_encoding($row["ZIP"], "UTF-8", "ISO-8859-2");
					$data .= "</ZIP>\n";

					$data .= "\t\t<STAT>";
					$data .= mb_convert_encoding($row["STAT"], "UTF-8", "ISO-8859-2");
					$data .= "</STAT>\n";

					$data .= "\t\t<RODINNY_STAV>";
					$data .= mb_convert_encoding($row["RODINNY_STAV"], "UTF-8", "ISO-8859-2");
					$data .= "</RODINNY_STAV>\n";

					$data .= "\t\t<POZICE>";
					$data .= mb_convert_encoding($row["POZICE"], "UTF-8", "ISO-8859-2");
					$data .= "</POZICE>\n";

					$data .= "\t\t<TYM>";
					$data .= mb_convert_encoding($row["TYM"], "UTF-8", "ISO-8859-2");
					$data .= "</TYM>\n";



				$data .= "\t</DOPROVODNY_TYM>\n";
			}
			$data .= "</DOPROVODNE_TYMY>\n";
			FWrite($fp, $data);// nahrani dat do souboru
			FClose($fp);	// zavreni souboru

			echo "<h2><font color=red> Export èlenù doprovodného týmu</font></h2>";
			echo "<tr><td>Export dokonèen. Byl vytvoøen soubor data.xml.</td></tr>";
			echo "<tr><td>Soubor je ulo¾en v adresáøové struktuøe www serveru. Pokud si jej chcete stáhnout, kliknìte na link</td></tr>";
			echo "<tr><td><a href='export_download.php' title='Download exportu'>Stáhnout vyexportovaný soubor.</a><tr><td>";
		}
	}

   if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
	{
		if ($_SESSION["access_time"] < strtotime(A_LOG_TIME))
		{
			$file = $files['automaticLogout'];
         require_once("$file");
			exit();
		}
		$_SESSION["access_time"] = time();
		writeXML();
	}
	else
   {
      $file = $files['enter'];
      header("Location: $file");
	}

   echo"
   </table>
   </div>";

?>