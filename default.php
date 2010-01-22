<?php

   /**
    * @TODO doelta kontrolu pro pridavani uzivatelu a nasledne jejich prava ....
    */

	include 'file.php';                   // katalog jmen použitých souborů - tady musí být přímá konstanta
	include $files['text'];               // katalog textových konstant
	include $files['const'];           // různé systémové a jiné konstanty
	require_once('connect.inc');

	

	/**
	 * Zobrazi informace stavu prihlaseni uzivatele
	 * @global <type> $text
	 */


	function showLogin() {

		global $text;             // globalni� texty

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


//...............................FUNKCE PRO KONTROLU OSOBY...............\\

   /**
    * Kontrola jmena
    *
    * @TODO doelat mezery ve jemnech
    */
   function checkNameM() {
      if( $_POST["name"] == "" )	// jmeno nesmi byt prazdne
      {
         $error["name"] = $text['no_name'][ $_SESSION['lang']];
      }
      //elseif( ereg("^ +$", $_POST["name"]) ) // nesmi obsahovat mezery
      //{
      //	$error["name"] = $text['no_name1'][ $_SESSION['lang']];
      //}
      elseif( strlen($_POST["name"]) > 50 || strlen($_POST["name"]) < 2)
      {
         $error["name"] = $text['no_name2'][ $_SESSION['lang']];
      }
      else
         $error["name"]="";
   }


   /**
    * Kontrola prijmeni
    *
    * @TODO doelat mezery ve jemnech
    */
   function checkSurnameM() {
      if( $_POST["surname"] == "" )	// prijmeni nesmi byt prazdne
      {
         $error["surname"] = $text['no_surname'][ $_SESSION['lang']];
      }
      //elseif( ereg("^ +$", $_POST["surname"]) ) // nesmi obsahovat mezery
      //{
      //	$error["surname"] = $text['no_surname1'][ $_SESSION['lang']];
      //}
      elseif( strlen($_POST["surname"]) > 50 || strlen($_POST["surname"]) < 2)
      {
         $error["surname"] = $text['no_surname2'][ $_SESSION['lang']];
      }
      else
         $error["surname"]="";
   }


   /**
    * Kontrola rodinneho stavu - povinne
    */
   function checkFamilyM() {
      if( $_POST["family"] == "---" )
      {
         $error['family']= $text['no_family'][ $_SESSION['lang']];
      }
      else
         $error['family']= "";
   }


   /**
    * Kontrola E-emilu
    */
   function checkEmail() {
      if( !ereg("^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$",$_POST["email"]) )
      {
         $error['email']= $text['no_email'][ $_SESSION['lang']];
      }
      else
         $error['email']= "";
   }

   /**
    * Kontrola rodneho cisla
    */
   function checkPersonalIdNum() {
      if( !ereg("^[0-9]{2}[0156]{1}[0-9]{1}[0-3]{1}[0-9]{1}[ /]?[0-9]{4}$",$_POST["perIdNum"]) )
      {
         $error['perIdNum']= $text['no_perIdNum'][ $_SESSION['lang']];
      }
      else
         $error['perIdNum']= "";
   }


   /**
    * Kontola telefonniho cisla
    */
   function checkPhoneNumber() {
      if( !ereg("^(([\+]|00){1}420)?[ /]?[0-9]{3}[ /]?[0-9]{3}?[0-9]{3}$",$_POST["phone"]) )
      {
         $error['phone']= $text['no_phone'][ $_SESSION['lang']];
      }
      else
         $error['phone']= "";
   }


   /**
    * KOntrola datumu - povinne
    */
   function checkDateM() {
      if( $_POST["date"] == "" )
      {
         $error['date']= $text['no_date'][ $_SESSION['lang']];
      }
      //elseif( !ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})",$_POST["date"]) )
      elseif( !ereg("^[0-3]{0,1}[0-9]{1}\.[0-1]{0,1}[0-9]{1}\.([0-9]{1,4}})?$",$_POST["date"], $regs))
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


//...............................FUNKCE PRO KONTROLU HRACE...............\\

   /**
    * Kontrola hraci pozice - povinne
    */
   function checkPozicionM() {
      if( $_POST["pozicion"] == "---" )
      {
         $error['pozicion']= $text['no_pozicion'][ $_SESSION['lang']];
      }
      else
         $error['pozicion']= "";
   }


   /**
    * Kontrola tymu - povinne
    */
   function checkTeamM() {
      if( $_POST["team"] == "---" )
      {
         $error['team']= $text['no_team'][ $_SESSION['lang']];
      }
      else
         $error['team']= "";
   }


   /**
    * Kontrola domaciho tymu
    */
   function checkHomeClub() {
      if( strlen($_POST["home_club"]) > 20 )
      {
         $error['home_club']= $text['no_home_club'][ $_SESSION['lang']];
      }
      else
         $error['home_club']="";
   }


   /**
    * Kontrola minuleho tymu
    */
   function checkLastClub() {
      if( strlen($_POST["last_club"]) > 20 )
      {
         $error["last_club"] = $text['no_last_club'][ $_SESSION['lang']];
      }
      else
         $error['last_club']= "";
   }

//...............................FUNKCE PRO KONTROLU AKCE...............\\

   /**
    * Kontrola minuty v zapsa
    *
    * @TODO zkontolovat jaky jde zadat rozsah minut, jesli i minus a nebo tvar 00012
    */
   function checkMinuteM() {
      if( $_POST["minute"] == "" )
      {
         $error["minute"] = $text['no_minute'][ $_SESSION['lang']];
      }
      else if( !ereg("^[0-9]{1,}$", $_POST["minute"], $regs)) ///jen cisla
      {
      	$error["minute"] = $text['no_minute2'][ $_SESSION['lang']];
      }
      else if( $_POST["minute"] > 120 )
      {
         $error["minute"] = $text['no_minute3'][ $_SESSION['lang']];
      }
      else
         $error['minute']= "";
   }


   /**
    * Kontrola vyberu zapsu - povinne
    */
   function checkMatchM() {
      if( $_POST["match"] == "---" )
      {
         $error["match"] = $text['no_team5'][ $_SESSION['lang']];
      }
      else
      {
         $error['match']= "";
      }
   }


   /**
    * Kontrola vyberu typu akce - povinne
    */
   function checkTypeActionM() {
      if( $_POST["type"] == "---" )
      {
         $error["action"] = $text['no_action'][ $_SESSION['lang']];
      }
      else
      {
         $error['action']= "";
      }
   }

   /**
    * Kontrola vyberu typu hrace - povinne
    */
   function checkPlayerM() {
      if( $_POST["player"] == "---" )
      {
         $error["player"] = $text['no_player'][ $_SESSION['lang']];
      }
      else
      {
         $error['player']= "";
      }
   }


//...............................FUNKCE PRO KONTROLU ZAPASU...............\\

   /**
    * Kontrola data konani zapasu
    */
   function checkMatchDateM() {
      if( $_POST["date"] == "" )
      {
         $error['date']= $text['no_date'][ $_SESSION['lang']];
      }
      elseif( !ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",$_POST["date"], $regs) )
      {
         $error['date']= $text['no_date1'][ $_SESSION['lang']];;
      }
      else
         $error['date']= "";
   }
         
   /**
    * Kontrola mista konani zapasu - povinne
    */
   function checkMatchPlaceM() {
      if( $_POST["place"] == "" )
      {
         $error['place']= $text['no_place'][ $_SESSION['lang']];
      }
      elseif( strlen($_POST["place"]) > 25 )
      {
         $error["place"] = $text['no_place1'][ $_SESSION['lang']];
      }
      else
         $error['place']= "";
   }


   /**
    * Kontrola skore - povinne
    */
   function checkMatchScoreM() {
      if( $_POST["score"] == "" )
      {
         $error['score']= "";
      }
      else if( strlen($_POST["score"]) > 5 )
      {
         $error["score"] = $text['no_score'][ $_SESSION['lang']];
      }
      else if( !ereg("^([0-9]{1,2}):([0-9]{1,2})$",$_POST["score"]) )	// musi mit tvar xx:xx
      {
         $error["score"] = $text['no_score1'][ $_SESSION['lang']];
      }
      else
         $error['score']= "";
   }


   /**
    * Kontrola nastaveni - povinne
    */
   function checkMatchOvertimeM() {
      if( $_POST["over_time"] == "" )
      {
         $error['over_time']= "";
      }
      else if( !ereg("^([1-9]{0,1})([0-9]{1})$",$_POST["over_time"]) )	// obsahovat jen cisla
      {
         $error["over_time"] = $text['no_over_time'][ $_SESSION['lang']];
      }
      else if( $_POST["over_time"] > 20 )
      {
         $error["over_time"] = $text['no_over_time1'][ $_SESSION['lang']];
      }
      else
         $error['over_time']= "";
   }


   /**
    * Kontrola poctu lidi - povinne
    */
   function checkMatchPeopleM() {
      if( $_POST["people"] == "" )
      {
         $error['people']= "";
      }
      else if( !ereg("^([1-9]{0,1})([0-9]{1})$",$_POST["people"]) )	// obsahovat jen cisla
      {
         $error["people"] = $text['no_people'][ $_SESSION['lang']];
      }
      else if( $_POST["people"] > 200000 )	// jen cisla do 200 000
      {
         $error["people"] = $text['no_people1'][ $_SESSION['lang']];
      }
      else
         $error['people']= "";
   }


   /**
    * Kontrola typu zapasu - povinne
    */
   function checkMatchTypeM() {
      if( $_POST["type"] == "---" )
      {
         $error['type']= $text['no_type'][ $_SESSION['lang']];
      }
      else if( $_POST["type"] == "skupina" && $_POST["group"] == "-")
      {
         $error['type']= $text['no_group'][ $_SESSION['lang']];
      }
      else
         $error['type']= "";
   }


   /**
    * Kontrola domacich - povinne
    */
   function checkMatchHomeM() {
      if( $_POST["team"] == $_POST["team2"] && ($_POST["team2"]!="---" || $_POST["team2"]!="---") )
      {
         $error['home_1']= $text['no_team3'][ $_SESSION['lang']];
         $error['guest_1']= $text['no_team3'][ $_SESSION['lang']];
      }
      else
      {
         $error['home_1']= "";
         $error['guest_1']= "";
      }
      if( $_POST["list"] == $_POST["list2"] && ($_POST["list"]!="---" || $_POST["list2"]!="---") )
      {
         $error['list_1']= $text['no_list'][ $_SESSION['lang']];
      }
      else
      {
         $error['list_1']= "";
      }
      if( $_POST["team"] == "---" )
      {
         $error['home']= $text['no_team'][ $_SESSION['lang']];
      }
      else
         $error['home']= "";
   }


   /**
    * Kontrola hostu - povinne
    */
   function checkMatchGuestM() {
      if( $_POST["team2"] == "---" )
      {
         $error['guest']= $text['no_team'][ $_SESSION['lang']];
      }
      else
         $error['guest']= "";
   }


   /**
    * Kontrola hlavniho rozhodciho - povinne
    */
   function checkMatchRefereeM() {
      if( ($_POST["referee"] == $_POST["referee2"] && ($_POST["referee"]!="---" || $_POST["referee2"]!="---")) ||
         ($_POST["referee"] == $_POST["referee3"] && ($_POST["referee"]!="---" || $_POST["referee3"]!="---")) ||
         ($_POST["referee"] == $_POST["referee4"] && ($_POST["referee"]!="---" || $_POST["referee4"]!="---")) ||
         ($_POST["referee2"] == $_POST["referee3"] && ($_POST["referee2"]!="---" || $_POST["referee3"]!="---")) ||
         ($_POST["referee3"] == $_POST["referee4"] && ($_POST["referee2"]!="---" || $_POST["referee4"]!="---")) ||
         ($_POST["referee4"] == $_POST["referee3"] && ($_POST["referee3"]!="---" || $_POST["referee4"]!="---"))
      )
      {
         $error['referee_1']= $text['no_referee'][ $_SESSION['lang']];
         $error['referee_2']= $text['no_referee'][ $_SESSION['lang']];
         $error['referee_3']= $text['no_referee'][ $_SESSION['lang']];
         $error['referee_4']= $text['no_referee'][ $_SESSION['lang']];
      }
      else
      {
         $error['referee_1']= "";
         $error['referee_2']= "";
         $error['referee_3']= "";
         $error['referee_4']= "";
      }
      if( $_POST["referee"] == "---" )
      {
         $error['referee']= $text['no_referee'][ $_SESSION['lang']];
      }
      else
         $error['referee']= "";
   }


   /**
    * Kontrola pomezniho rozhodciho - povinne
    */
   function checkMatchReferee2M() {
      if( $_POST["referee2"] == "---" )
      {
         $error['referee2']= $text['no_referee'][ $_SESSION['lang']];
      }
      else
         $error['referee2']= "";
   }


   /**
    * Kontrola pomezniho rozhodciho - povinne
    */
   function checkMatchReferee3M() {
      if( $_POST["referee3"] == "---" )
      {
         $error['referee3']= $text['no_referee'][ $_SESSION['lang']];
      }
      else
         $error['referee3']= "";
   }


   /**
    * Kontrola pomocneho rozhodciho - povinne
    */
   function checkMatchReferee4M() {
      if( $_POST["referee4"] == "---" )
      {
         $error['referee4']= $text['no_referee'][ $_SESSION['lang']];
      }
      else
         $error['referee4']= "";
   }


//...............................FUNKCE PRO KONTROLU TYMU.................\\

   /**
    * Kontrola zkratky tymu - povinne
    */
   function checkCodeM() {
      if( $_POST["code"] == "" )
      {
         $error["code"] = $text['no_code'][ $_SESSION['lang']];
      }
      elseif( strlen($_POST["code"]) > 3 || strlen($_POST["code"]) < 2 )
      {
         $error["code"] = $text['no_code1'][ $_SESSION['lang']];
      }
      elseif( !ereg("^".$czechWord."+$", $_POST["code"]) )
      {
         $error["code"] = $text['no_code2'][ $_SESSION['lang']];
      }
      else
         $error['code']= "";
   }


   /**
    * Kontrola jmena tymu - povinne
    */
   function checkNameStateM() {
      if( $_POST["state"] == "" )
      {
         $error["state"] = $text['no_state1'][ $_SESSION['lang']];
      }
      elseif( strlen($_POST["state"]) > 25 )
      {
         $error["state"] = $text['no_state2'][ $_SESSION['lang']];
      }
      else
         $error['state']= "";
   }


   /**
    * Kontrola vyberu skupiny - povinne
    */
   function checkGrooupM() {
      if( $_POST["group"] == "-" )
      {
         $error['group']= $text['no_group'][ $_SESSION['lang']];
      }
      else
         $error['group']= "";
   }


   /**
    * Kontrola sloganu
    */
   function checkSlogan() {
      if( strlen($_POST["slogan"]) > 150 )
      {
         $error["slogan"] = $text['no_slogan'][ $_SESSION['lang']];
      }
      else
         $error['slogan']= "";
   }


//...............................FUNKCE PRO KONTROLU ADRESY...............\\

   /**
    * Kontrola rodiste - povinne
    */
   function checkHometownM() {
      if( $_POST["hometown"] == "" )
      {
         $error['hometown']= $text['no_hometown'][ $_SESSION['lang']];
      }
      elseif( strlen($_POST["hometown"]) > 25 )
      {
         $error["hometown"] = $text['no_hometown1'][ $_SESSION['lang']];
      }
      else
         $error['hometown']= "";
   }

   /**
    * Kontrola rodiste
    */
   function checkHometown() {
      if( strlen($_POST["hometown"]) > 25 )
      {
         $error["hometown"] = $text['no_hometown1'][ $_SESSION['lang']];
      }
      else
         $error['hometown']= "";
   }


   /**
    * Kontrola ulice
    */
   function checkStreet() {
      if( strlen($_POST["street"]) > 20 )
      {
         $error["street"] = $text['no_street'][ $_SESSION['lang']];
      }
      else
         $error['street']= "";
   }


   /**
    * Kontrola mesta
    */
   function checkCity() {
      if( strlen($_POST["city"]) > 20 )
      {
         $error["city"] = $text['no_city'][ $_SESSION['lang']];
      }
      else
         $error['city']= "";
   }


   /**
    * Kontrola smerovaciho cisla - povinne
    */
   function checkZipM() {
      if( $_POST["zip"] == "" )
      {
         $error['zip']= "";
      }
      else
      {
         if( !ereg("^([0-9]{4,5})$",$_POST["zip"]) )
         {
            $error['zip']= $text['no_zip'][ $_SESSION['lang']];;
         }
         else
            $error['zip']= "";
      }
   }


   /**
    * Kontrola smerovaciho cisla
    */
   function checkZip() {
      if( !ereg("^([0-9]{4,5})$",$_POST["zip"]) )
      {
         $error['zip']= $text['no_zip'][ $_SESSION['lang']];;
      }
      else
         $error['zip']= "";
   }


   /**
    * Kontrola statu - povinne
    */
   function checkStateM() {
      if( $_POST["state"] == "" )
      {
         $error['state']= "";
      }
      else
      {
         if( strlen($_POST["state"]) > 3 || strlen($_POST["state"]) < 2 )
            {
            $error["state"] = $text['no_state'][ $_SESSION['lang']];
         }
         else
            $error['state']= "";
      }
   }


   /**
    * Kontrola statu
    */
   function checkState() {
      if( strlen($_POST["state"]) > 3 || strlen($_POST["state"]) < 2 )
         {
         $error["state"] = $text['no_state'][ $_SESSION['lang']];
      }
      else
         $error['state']= "";
   }