<?php

	include 'file.php';                   // katalog jmen použitých souborů - tady musí být přímá konstanta
	include $files['text'];               // katalog textových konstant
	include $files['const'];           // různé systémové a jiné konstanty
	require_once('connect.inc');

	

	/**
	 * Zobrazi informace stavu prihlaseni uzivatele
	 * @global <type> $text
	 */


	function showLogin() {

		global $text;             // globální texty

		if( isset($_SESSION['login']) )	//kontrola zda je uzivatel prihlasen
		{
			// echo je prihlasen
		}
		else	// neni prilasen
		{
			// echo neni prihlasen
		}
	}


	/**
	 * Odstraneni escape znaku a prevedeni zvlastnich znaku na HTML entity
	 * @param <type> $srt retezec jez se ma zkontrolovat
	 * @return <type> $tmp
	 */
	function checkEscape($srt) {

		$tmp = HTMLSpecialChars($srt);		// prevedeni zvlastnich znaku na HTML entity
		$tmp = EscapeShellCmd($tmp);			// dstraneni escape znaku

		return ($tmp);
	}

	/**
	 * Zobrazi aktualni obsah globalni promenne $_POST
	 */
	function showPOST() {

		$query_string = "";
		if( $_POST )
		{
			$kv = array();
			foreach( $_POST as $key => $value )
			{
				$kv[] = "$key=$value";
			}
			$query_string = join("&", $kv);
		}
		else
		{
			$query_string = $_SERVER['QUERY_STRING'];
		}
		echo $query_string;
	}


	/**
	 *
	 * @global <type> $text
	 * @global <type> $defaultLanguage 
	 */
	function callDropdownFamily() {

		global $text;
		global $defaultLanguage;
		$pairs[$text['f_unmarried'][$defaultLanguage]] = $text['f_unmarried'][$defaultLanguage];
		$pairs[$text['f_married'][ $defaultLanguage]] = $text['f_married'][ $defaultLanguage];
		$pairs[$text['f_divorced'][$defaultLanguage]] = $text['f_divorced'][$defaultLanguage];
		$pairs[$text['f_widower'][$defaultLanguage]] = $text['f_widower'][$defaultLanguage];

		if( empty($_POST))
				echo createDropdown("family", $pairs, "---", "---");
			else
				echo createDropdown("family", $pairs, "---", $_POST["family"]);
	}


	/**
	 *
	 * @param <type> $identifier
	 * @param <type> $pairs
	 * @param <type> $firstentry
	 * @param <type> $selectedkey
	 * @return <type> 
	 */
	function createDropdown($identifier, $pairs, $firstentry, $selectedkey="") {

		$dropdown = "<select name=\"$identifier\" >";
		$dropdown .= "<option name=\"\">$firstentry</option>";

		foreach($pairs AS $value => $country)
		{
			$dropdown .= ($value == $selectedkey) ?
			"<option name=\"$value\" selected=\"selected\">$country</option>" :
			"<option name=\"$value\">$country</option>";
		}
		$dropdown .= "</select>";

		return $dropdown;
	}

	/**
	 *
	 * @param <type> $identifier
	 * @param <type> $pairs
	 * @param <type> $firstentry
	 * @param <type> $selectedkey
	 * @return <type>
	 */
	function createDropdownDb($identifier, $pairs, $firstentry, $selectedkey="") {

		$dropdown = "<select name=\"$identifier\" >";
		$dropdown .= "<option name=\"\">$firstentry</option>";

		foreach($pairs AS $value => $country)
		{
			$dropdown .= ($value == $selectedkey) ?
			"<option name=\"$value\" selected=\"selected\">$country</option>" :
			"<option name=\"$value\">$country</option>";
		}
		$dropdown .= "</select>";
		return $dropdown;
	}

	function fillDropdownTeam() {
		$query = mysql_query("SELECT KOD_ZEME FROM `TYM` ORDER BY KOD_ZEME");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["KOD_ZEME"];
				//$country = $row["ZEME"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("team", $pairs, "---", "---");
			else
				echo createDropdownDb("team", $pairs, "---", $_POST["team"]);
		}
	}

	function fillDropdownTeam2() {
		$query = mysql_query("SELECT KOD_ZEME FROM `TYM` ORDER BY KOD_ZEME");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["KOD_ZEME"];
				//$country = $row["ZEME"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("team2", $pairs, "---", "---");
			else
				echo createDropdownDb("team2", $pairs, "---", $_POST["team2"]);
		}
	}

	function fillDropdownReferee() {
		$query = mysql_query("SELECT PRIJMENI FROM `ROZHODCI` ORDER BY PRIJMENI");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["PRIJMENI"];
				//$country = $row["ZEME"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("referee", $pairs, "---", "---");
			else
				echo createDropdownDb("referee", $pairs, "---", $_POST["referee"]);
		}
	}

	function fillDropdownReferee2() {
		$query = mysql_query("SELECT PRIJMENI FROM `ROZHODCI` ORDER BY PRIJMENI");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["PRIJMENI"];
				//$country = $row["ZEME"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("referee2", $pairs, "---", "---");
			else
				echo createDropdownDb("referee2", $pairs, "---", $_POST["referee2"]);
		}
	}

	function fillDropdownReferee3() {
		$query = mysql_query("SELECT PRIJMENI FROM `ROZHODCI` ORDER BY PRIJMENI");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["PRIJMENI"];
				//$country = $row["ZEME"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("referee3", $pairs, "---", "---");
			else
				echo createDropdownDb("referee3", $pairs, "---", $_POST["referee3"]);
		}
	}

	function fillDropdownReferee4() {
		$query = mysql_query("SELECT PRIJMENI FROM `ROZHODCI` ORDER BY PRIJMENI");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["PRIJMENI"];
				//$country = $row["ZEME"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("referee4", $pairs, "---", "---");
			else
				echo createDropdownDb("referee4", $pairs, "---", $_POST["referee4"]);
		}
	}

	function fillDropdownList() {
		$query = mysql_query("SELECT JMENO FROM `SOUPISKA` ORDER BY JMENO");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["JMENO"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("list", $pairs, "---", "---");
			else
				echo createDropdownDb("list", $pairs, "---", $_POST["list"]);
		}
	}

	function fillDropdownList2() {
		$query = mysql_query("SELECT JMENO FROM `SOUPISKA` ORDER BY JMENO");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["JMENO"];
				$pairs["$value"] = $value;//country;
			}
			if( empty($_POST))
				echo createDropdownDb("list2", $pairs, "---", "---");
			else
				echo createDropdownDb("list2", $pairs, "---", $_POST["list2"]);
		}
	}

	/**
	 *
	 * @global <type> $text
	 * @global <type> $defaultLanguage
	 */
	function callDropdownPozicionEscort() {

		global $text;
		global $defaultLanguage;
		$pairs[$text['f_coach'][$defaultLanguage]] = $text['f_coach'][$defaultLanguage];
		$pairs[$text['f_assistant'][ $defaultLanguage]] = $text['f_assistant'][ $defaultLanguage];
		$pairs[$text['f_doctor'][$defaultLanguage]] = $text['f_doctor'][$defaultLanguage];
		$pairs[$text['f_maser'][$defaultLanguage]] = $text['f_maser'][$defaultLanguage];

		if( empty($_POST))
				echo createDropdown("pozicion", $pairs, "---", "---");
			else
				echo createDropdown("pozicion", $pairs, "---", $_POST["pozicion"]);
	}

	function fillDropdownGroup() {
		$query = mysql_query("SELECT JMENO FROM `SKUPINA` ORDER BY JMENO");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["JMENO"];
				$pairs["$value"] = $value;
			}
			if( empty($_POST))
				echo createDropdownDb("group", $pairs, "-", "-");
			else
				echo createDropdownDb("group", $pairs, "-", $_POST["group"]);
		}
	}

	/**
	 *
	 * @global <type> $text
	 * @global <type> $defaultLanguage
	 */
	function callDropdownPozicionType() {

		global $text;
		global $defaultLanguage;

		$pairs[$text['f_group'][$defaultLanguage]] = $text['f_group'][$defaultLanguage];
		$pairs[$text['f_eightfinal'][$defaultLanguage]] = $text['f_eightfinal'][$defaultLanguage];
		$pairs[$text['f_quarterfinal'][$defaultLanguage]] = $text['f_quarterfinal'][$defaultLanguage];		
		$pairs[$text['f_semifinal'][$defaultLanguage]] = $text['f_semifinal'][$defaultLanguage];
		$pairs[$text['f_final'][$defaultLanguage]] =$text['f_final'][$defaultLanguage];

		if( empty($_POST))
				echo createDropdown("type", $pairs, "---", "---");
			else
				echo createDropdown("type", $pairs, "---", $_POST["type"]);
	}


	function fillDropdownAction() {
		$query = mysql_query("SELECT ID_ZAPAS, DOMACI, HOSTE FROM `ZAPAS` ORDER BY DATUM");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				$value = $row["DOMACI"];
				$value .="-";
				$value .=$row["HOSTE"];
				$id = $row["ID_ZAPAS"];
				$pairs["$value"] = $value;
			}
			if( empty($_POST))
				echo createDropdownDb("match", $pairs, "---", "---");
			else
				echo createDropdownDb("match", $pairs, "---", $_POST["match"]);
		}
	}

	function fillDropdownActionPlayer() {
		$query = mysql_query("SELECT JMENO, PRIJMENI, ID_HRAC FROM `HRAC` ORDER BY PRIJMENI ;");
		if( !$query )	// nepovedlo se ziskat data
		{
			echo "<h2>NEZISKALI JSM EDTA</h2>";
		}
		else
		{
			while( $row = mysql_fetch_array($query) )
			{
				//$value = $row["JMENO"];
				//$value .-" ";
				$value =$row["PRIJMENI"];
				//$id = $row["ID_HRAC"];
				$pairs["$value"] = $value;
			}
			if( empty($_POST))
				echo createDropdownDb("player", $pairs, "---", "---");
			else
				echo createDropdownDb("player", $pairs, "---", $_POST["player"]);
		}
   }

   function checkDate() {
      if( $_POST["date"] == "" )
      {
         $error['date']= $text['no_date'][ $_SESSION['lang']];
      }
      //elseif( !ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})",$_POST["date"]) )
      elseif( !ereg("^[0-3]{0,1}[0-9]{1}\.[0-1]{0,1}[0-9]{1}\.([0-9]{1,4}})?$",$_POST["date"]))
      {
         $error['date']= $text['no_date1'][ $_SESSION['lang']];
      }
      else if( $regs[1]>2000 || $regs[1]<1900 || $regs[2] > 12 || $regs[2]== 0 || $regs[3]>31 || $regs[3]==0)
      {
         $error['date']= $text['no_date2'][ $_SESSION['lang']];
      }
      else
         $error['date']= "";
   }
