<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

		<?php
/**
 * todo : zkontrolovat soupisku-zapas, koliduji jmena soupiske a hrajicich muzstev
 */
			require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor

			include 'file.php';
			include $files['text'];	// katalog textových konstant
			include $files['const'];

			global $languageCz;
			global $languageEng;
			global $defaultLanguage;

//prozatim dodelat SESIOIN
			$_SESSION['lang'] = $defaultLanguage;

			if( isset($_POST["souhlas"]) )// maji se nainstalovat data//Testuje jestli promìnná existuje. Pokud je promìnná zinicializovaná a má nenulový obsah vrací funkce TRUE, v opaèném pøípadì vrací FALSE.
			{
				if( $_POST["souhlas"] == $languageCz )
					$_SESSION['lang'] = $languageCz;
				else
					$_SESSION['lang'] = $languageEng;

				$create = TRUE;

				echo "<h2>".$text['n_create'][ $_SESSION['lang']]."</h2>";

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `USER` (
											`LOGIN` varchar(30) NOT NULL,
											`PASS` varchar(50) NOT NULL,
											`JMENO` VARCHAR(50) DEFAULT '' NOT NULL,
											`PRIJMENI` VARCHAR(50) DEFAULT '' NOT NULL,
											`EMAIL` varchar(100) NOT NULL,
											`STAV` varchar(10),
											PRIMARY KEY (`LOGIN`)
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>".$text['not_create_table'][ $_SESSION['lang']]." USER.</h2>";
				}
				else
				{
					echo "<h2>USER ".$text['create_table'][ $_SESSION['lang']]."</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `ROZHODCI` (
											`ID_ROZHODCI` int(5) NOT NULL auto_increment,
											`JMENO` VARCHAR(50) DEFAULT '' NOT NULL,
											`PRIJMENI` VARCHAR(50) DEFAULT '' NOT NULL,
											`DATUM_NAROZENI` DATE NOT NULL,
											`RODISTE` VARCHAR(25),
											`ULICE` VARCHAR(25),
											`MESTO` VARCHAR(25),
											`ZIP` VARCHAR(10),
											`STAT` VARCHAR(4),
											`RODINNY_STAV` VARCHAR(10),
											PRIMARY KEY (`ID_ROZHODCI`)
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>".$text['not_create_table'][ $_SESSION['lang']]." ROZHODCI.</h2>";
				}
				else
				{
					echo "<h2>ROZHODCI ".$text['create_table'][ $_SESSION['lang']]."</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `TYM` (
											`KOD_ZEME` VARCHAR(3) DEFAULT '' NOT NULL,
											`ZEME` VARCHAR(25) DEFAULT '' NOT NULL,
											`SKUPINA` VARCHAR(2) DEFAULT'' NOT NULL,
											`SLOGAN` varchar(150),
											PRIMARY KEY (`KOD_ZEME`)
											)DEFAULT CHARSET=latin2;"
											);

				if( !$query )
				{
					$create = FALSE;
					echo "<h2>".$text['not_create_table'][ $_SESSION['lang']]." TYM.</h2>";
				}
				else
				{
					echo "<h2>TYM".$text['create_table'][ $_SESSION['lang']]."</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `DOPROVODNY_TYM` (
											`ID_DOPROVODNY_TYM` int(5) NOT NULL auto_increment,
											`JMENO` VARCHAR(50) DEFAULT '' NOT NULL,
											`PRIJMENI` VARCHAR(50) DEFAULT '' NOT NULL,
											`DATUM_NAROZENI` DATE NOT NULL,
											`RODISTE` VARCHAR(25) DEFAULT '' NOT NULL,
											`ULICE` VARCHAR(15),
											`MESTO` VARCHAR(15),
											`ZIP` varchar(8),
											`STAT` VARCHAR(15),
											`RODINNY_STAV` VARCHAR(10) DEFAULT '' NOT NULL,
											`POZICE` VARCHAR(10) DEFAULT '' NOT NULL,
											`TYM` VARCHAR(3) DEFAULT '' NOT NULL,
											PRIMARY KEY (`ID_DOPROVODNY_TYM`)
											)DEFAULT CHARSET=latin2;"
											);
											//FOREIGN KEY (`TYM`) REFERENCES TYM(`KOD_ZEME`) ON DELETE CASCADE
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>".$text['not_create_table'][ $_SESSION['lang']]." DOPROVODNY_TYM </h2>";
				}
				else
				{
					echo "<h2>";
					echo "TYM ";
					echo $text['create_table'][ $_SESSION['lang']];
					echo "</h2>";
				}
				$query = mysql_query("CREATE TABLE IF NOT EXISTS `SKUPINA` (
											`JMENO` VARCHAR(1) DEFAULT '' NOT NULL,
											`MESTO` VARCHAR(15) DEFAULT '' NOT NULL,
											`TYM_1` VARCHAR(3) NULL,
											`TYM_2` VARCHAR(3) NULL,
											`TYM_3` VARCHAR(3) NULL,
											`TYM_4` VARCHAR(3) NULL,
											PRIMARY KEY (`JMENO`)
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>";
					echo $text['not_create_table'][ $_SESSION['lang']];
					echo " SKUPINA.";
					echo "</h2>";
				}
				else
				{
					echo "<h2>";
					echo "SKUPINA ";
					echo $text['create_table'][ $_SESSION['lang']];
					echo "</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `HRAC` (
											`ID_HRAC` int(5) NOT NULL auto_increment,
											`JMENO` VARCHAR(50) DEFAULT '' NOT NULL,
											`PRIJMENI` VARCHAR(50) DEFAULT '' NOT NULL,
											`HRACI_POZICE` VARCHAR(15) DEFAULT '' NOT NULL,
											`DATUM_NAROZENI` DATE NOT NULL,
											`DOMOVSKY_KLUB` VARCHAR(20) DEFAULT '' NULL,
											`RODISTE` VARCHAR(25) DEFAULT '' NOT NULL,
											`BYVALY_KLUB` VARCHAR(20),
											`ULICE` VARCHAR(20),
											`MESTO` VARCHAR(15),
											`ZIP` varchar(8),
											`STAT` VARCHAR(10),
											`RODINNY_STAV` VARCHAR(15) DEFAULT '' NOT NULL,
											`TYM` VARCHAR(3) DEFAULT '' NOT NULL,
											PRIMARY KEY (`ID_HRAC`)
											)DEFAULT CHARSET=latin2;"
											);
											//FOREIGN KEY (`TYM`) REFERENCES TYM(`KOD_ZEME`)
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>";
					echo $text['not_create_table'][ $_SESSION['lang']];
					echo " HRAC.";
					echo "</h2>";
				}
				else
				{
					echo "<h2>";
					echo "HRAC ";
					echo $text['create_table'][ $_SESSION['lang']];
					echo "</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `SOUPISKA` (
											`ID_SOUPISKA` int(5) NOT NULL auto_increment,
											`JMENO` varchar(8) NOT NULL,
											`ODEHRANY_CAS` int(10) NULL,
											`HRAC_1` int(5),
											`HRAC_2` int(5),
											`HRAC_3` int(5),
											`HRAC_4` int(5),
											`HRAC_5` int(5),
											`HRAC_6` int(5),
											`HRAC_7` int(5),
											`HRAC_8` int(5),
											`HRAC_9` int(5),
											`HRAC_10` int(5),
											`HRAC_11` int(5),
											`HRAC_12` int(5),
											`HRAC_13` int(5),
											`HRAC_14` int(5),
											`HRAC_15` int(5),
											`HRAC_16` int(5),
											PRIMARY KEY (`ID_SOUPISKA`)
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>";
					echo $text['not_create_table'][ $_SESSION['lang']];
					echo " SOUPISKA.";
					echo "</h2>";
				}
				else
				{
					echo "<h2>";
					echo "SOUPISKA ";
					echo $text['create_table'][ $_SESSION['lang']];
					echo "</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `ZAPAS` (
											`ID_ZAPAS` int(5) NOT NULL auto_increment,
											`DATUM` DATETIME NOT NULL,
											`MISTO` VARCHAR(25) DEFAULT '' NOT NULL,
											`DOMACI` VARCHAR(3) DEFAULT '' NOT NULL,
											`HOSTE` VARCHAR(3) DEFAULT '' NOT NULL,
											`VYSLEDEK` VARCHAR(5),
											`NASTAVENY_CAS` int(5),
											`POCET_DIVAKU` int(7),
											`TYP_ZAPASU` VARCHAR(11) DEFAULT '' NOT NULL,
											`ROZ_HLAVNI` int(5) NOT NULL,
											`ROZ_POMEZ1` int(5) NOT NULL,
											`ROZ_POMEZ2` int(5) NOT NULL,
											`ROZ_POMOCNY` int(5) NOT NULL,
											`SOUPISKA1` varchar(8),
											`SOUPISKA2` varchar(8),
											`SKUPINA` VARCHAR(1) DEFAULT '',
											PRIMARY KEY (`ID_ZAPAS`)
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>";
					echo $text['not_create_table'][ $_SESSION['lang']];
					echo " ZAPAS.";
					echo "</h2>";
				}
				else
				{
					echo "<h2>";
					echo "ZAPAS ";
					echo $text['create_table'][ $_SESSION['lang']];
					echo "</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `AKCE` (
											`ID_AKCE` int(5) NOT NULL auto_increment,
											`MINUTA` int(5) NOT NULL,
											`TYP_AKCE` VARCHAR(15) NOT NULL,
											`HRAC` int(5) NOT NULL,
											`ZAPAS` int(5) NOT NULL,
											PRIMARY KEY (`ID_AKCE`),
											FOREIGN KEY (`HRAC`) REFERENCES HRAC(`ID_HRAC`),
											FOREIGN KEY (`ZAPAS`) REFERENCES ZAPAS(`ID_ZAPAS`)
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>".$text['not_create_table'][ $_SESSION['lang']]." AKCE.</h2>";
				}
				else
				{
					echo "<h2> AKCE ".$text['create_table'][ $_SESSION['lang']]."</h2>";
				}

				$query = mysql_query("CREATE TABLE IF NOT EXISTS `ODEHRANY_CAS` (
											`ID_ODE_CAS` int(5) NOT NULL auto_increment,
											`OD` int(3) DEFAULT '0' NOT NULL,
											`D0_C` int(3) DEFAULT '0',
											`HRAC` int(5) NOT NULL,
											`ZAPAS` int(5) NOT NULL,
											PRIMARY KEY (`ID_ODE_CAS`),
											FOREIGN KEY (`HRAC`) REFERENCES HRAC(`ID_HRAC`) ON DELETE CASCADE,
											FOREIGN KEY (`ZAPAS`) REFERENCES ZAPAS(`ID_ZAPAS`) ON DELETE CASCADE
											)DEFAULT CHARSET=latin2;"
											);
				if( !$query )
				{
					$create = FALSE;
					echo "<h2>";
					echo $text['not_create_table'][ $_SESSION['lang']];
					echo " ODEHRANY_CAS.";
					echo "</h2>";
				}
				else
				{
					echo "<h2>";
					echo "ODEHRANY_CAS ";
					echo $text['create_table'][ $_SESSION['lang']];
					echo "</h2>";
				}

				//naplnit databazy daty, pokud se povedlo vytvorit vsechny tabulky
				if( $create )
				{
					echo "<h2>";
					echo $text['n_insert'][ $_SESSION['lang']];
					echo "</h2>";

					$query = mysql_query("INSERT INTO `USER`
								(LOGIN, PASS, JMENO, PRIJMENI, EMAIL, STAV) VALUES
								('editor', '5aee9dbd2a188839105073571bee1b1f','Ivan','Maly','ivan@maly.cz', 'editor'),
								('admin', '21232f297a57a5a743894a0e4a801fc3','Karel','Stredni','karel@stredni.cz', 'admin'),
								('user', 'ee11cbb19052e40b07aac0ca060c23ee','Pepa','Veliky','pepa@veliky.cz', 'user');"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." USER.</h2>";
					}
					else
					{
						echo "<h2>USER ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}

					$query = mysql_query("INSERT INTO `ROZHODCI`
								(ID_ROZHODCI, JMENO, PRIJMENI, DATUM_NAROZENI, RODISTE, ULICE, MESTO, ZIP, STAT, RODINNY_STAV) VALUES
								(50, 'Pierluigi', 'Collina', '1960-2-15', 'Bologni', 'Parte', 'Bologni', '34567', 'ITA', 'zenaty'),
								(51, 'Dagmar', 'Damkova', '1960-1-27', 'Plzen', 'Velak', 'Plzen', '76854','CZE', 'vdana'),
								(52, 'John', 'Smith', '1967-3-22', 'Londyn', 'Green street', 'Londyn' ,'65331', 'ENG','svobodny'),
								(53, 'Sean', 'Faris', '1975-12-24', 'Novelda', 'St.Patric Street', 'Barcelona', '23424', 'SPA', 'zenaty');"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " ROZHODCI.";
						echo "</h2>";
					}
					else
					{
						echo "<h2>";
						echo "ROZHODCI ";
						echo $text['insert_table'][ $_SESSION['lang']];
						echo "</h2>";
					}

					$query = mysql_query("INSERT INTO `TYM` (KOD_ZEME, ZEME, SKUPINA, SLOGAN) VALUES
								('CRC', 'KOSTARIKA', 'A', 'Ná¹ tým je na¹e zbraò, na¹í zbraní je míè. Pojïme na mistrovství v¹ichni odevzdat du¹i a srdce'),
								('ENG', 'ANGLIE', 'B', 'Jeden národ, jedna trofej, jedenáct lvù'),
								('SWE', 'Svedsko', 'B', 'Bijte se! Odvahu! Do toho! Celé ©védsko stojí za vámi!'),
								('PAR', 'Paraguay', 'B', 'Duch lidu Guaraní ze srdce Ameriky'),
								('TRI', 'Trinidad a Tobago', 'B', 'Soca Warriors pøijí¾dìjí, duch bojovníkù z Karibiku'),
								('ARG', 'Argentina', 'C', 'Povstaòte, Argentina postupuje dál'),
								('NED', 'Nizozemsko', 'C', 'Oran¾oví na cestì ke zlatu'),
								('CIV', 'Pobrezi slonoviny', 'C', 'Do boje, sloni! Vyhrajte mistrovství svìta elegantním fotbalem'),
								('SCG', 'Srbsko a Cerna Hora', 'C', 'Z lásky ke høe'),
								('PRT', 'Portugalsko', 'D', 'Na oknì vlajka, na trávníku celý národ'),
								('MEX', 'Mexico', 'D', 'Mexický výbìr: aztécká vá¹eò, která zaplaví svìt'),
								('AGO', 'Angola', 'D', 'Angola ukazuje cestu. Ná¹ tým je na¹ím lidem.'),
								('IRN', 'Iran', 'D', 'Hvìzdy Persie'),
								('ITA', 'Italie', 'E', 'Modrá vìrnost, Itálie v na¹ich srdcích'),
								('GHA', 'Ghana', 'E', 'Black Stars do toho, hvìzdy na¹eho svìta'),
								('CZE', 'Cesko', 'E', 'Budem se rvát jako lvi, pro vítìzství a fanou¹ky'),
								('USA', 'Spojene staty americke', 'E', 'Sjednoceni hrajeme, sjednoceni zvítìzíme'),
								('BRA', 'Brazilie', 'F', 'Vùz sledovaný 180 miliony brazilských srdcí'),
								('AUS', 'Australie', 'F', 'Austral¹tí Socceroos ? Na cestì ke slávì'),
								('HRV', 'Chorvatsko', 'F', 'Na cestì do finále s ohnìm v srdcích'),
								('JPN', 'Japonsko', 'F', 'Probuïte ducha samurajù!'),
								('CHE', 'Svycarsko', 'G', '2006, hodina ©výcarska!'),
								('FRA', 'Francie', 'G', 'Svoboda, rovnost, Jules Rimet!'),
								('KOR', 'Jizni Korea', 'G', 'Spojená Korea, vìèná legenda'),
								('TGO', 'Togo', 'G', 'Hráèská vá¹eò a ¾ízeò k vítìství!'),
								('ESP', 'Spanelsko', 'H', '©panìlsko. Jedna zemì. Jedna nadìje.'),
								('UKR', 'Ukrajina', 'H', 'S na¹í podporou, Ukrajina musí zvítìzit'),
								('TUN', 'Tunisko', 'H', 'Orlové z Kartága, v¾dy nejvý¹e, v¾dy nejsilnìj¹í'),
								('SAU', 'Saudska Arabie', 'H', 'Zelení sokolové jsou neporazitelní');"
								);

						/*		('GER', 'Nemecko', 'A', 'Pro Nìmecko - Nìmeckem'),
								('ECU', 'EKVADOR', 'A', 'Ekvádor je mùj ¾ivot, fotbal je má vá¹eò, vítìzství mùj cíl'),
								('POL', 'POLSKO', 'A', 'Bílo-èervení! Odvá¾ní a nebezpeèní!'),
						 *
						 */
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " TYM.";
						echo "</h2>";
					}
					else
					{
						echo "<h2>";
						echo "TYM ";
						echo $text['insert_table'][ $_SESSION['lang']];
						echo "</h2>";
					}


					$query = mysql_query("INSERT INTO `DOPROVODNY_TYM`
								(ID_DOPROVODNY_TYM, JMENO, PRIJMENI, DATUM_NAROZENI, RODISTE, ULICE, MESTO, ZIP, STAT, RODINNY_STAV, POZICE, TYM) VALUES
								(1, 'Petr', 'Rada', '1958-8-21', 'Praha', 'Mokra', 'Praha 2', '72345', 'CZE', 'zenaty', 'trener', 'CZE'),
								(2, 'Loris', 'Capirossi', '1980-5-16', 'Rim', 'St.Paulo Street', 'Rim', '46346', 'ITA','svobodny','trener','ITA'),
								(3, 'Michael', 'Mateasko', '1970-9-15', 'Radom', 'ulica Rolna', 'Skierniewice', '65656', 'POL', 'zenaty', 'asistent','POL'),
								(4, 'Bela', 'Glattfelder', '1960-2-13', 'Godolo', 'Foutca', 'Tatabanya', '46365', 'SAU', 'zenaty', 'asistent', 'GHA'),
								(5, 'Szabolcs', 'Fazakas', '1971-9-09', 'Budapest', 'Mesterutca', 'Budapest', '64363','HUN', 'zenaty', 'asistent','TUN');"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " DOPROVODNY_TYM.";
						echo "</h2>";
					}
					else
					{
						echo "<h2>";
						echo "DOPROVODNY_TYM ";
						echo $text['insert_table'][ $_SESSION['lang']];
						echo "</h2>";
					}

					$query = mysql_query("INSERT INTO `SKUPINA` (JMENO, MESTO, TYM_1, TYM_2, TYM_3, TYM_4) VALUES
								('A', 'Hamburg', NULL, NULL, 'CRC', NULL),
								('B', 'Hannover', 'ENG', 'SWE', 'PAR', 'TRI'),
								('C', 'Berlin', 'ARG', 'NED', 'CIV', 'SCG'),
								('D', 'Dortmund', 'PRT', 'MEX', 'AGO', 'IRN'),
								('E', 'Mnichov', 'ITA', 'GHA', 'CZE', 'USA'),
								('F', 'Stuttgart', 'BRA', 'AUS', 'HRV', 'JPN'),
								('G', 'Frankfurt', 'CHE', 'FRA', 'KOR', 'TGO'),
								('H', 'Kolin', 'ESP', 'UKR', 'TUN', 'SAU');"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " SKUPINA.";
						echo "</h2>";
					}
					else
					{
						echo "<h2>";
						echo "SKUPINA ";
						echo $text['insert_table'][ $_SESSION['lang']];
						echo "</h2>";
					}

					$query = mysql_query("INSERT INTO `HRAC`
								(ID_HRAC, JMENO, PRIJMENI, HRACI_POZICE, DATUM_NAROZENI, DOMOVSKY_KLUB, RODISTE, BYVALY_KLUB, ULICE, MESTO, ZIP, STAT, RODINNY_STAV, TYM) VALUES
								(600, 'Chris', 'Egan', 'brankáø', '1981-11-03', 'Valegra', 'Sydney', ' FC Mochto', 'St.Verona St.', 'Sydney', '56457', 'AUS', 'svobodný', 'AUS'),
								(601, 'Alain', 'Bashung', 'zálo¾ník', '1976-7-09', 'Valegra', 'Pariz', 'Lyon', 'Rue Daval', 'Pariz', '44656', 'FRA', '¾enatý', 'ITA'),
								(602, 'Pablo', 'Abraira', 'útoèník', '1986-3-04', ' FC Madrid', 'Madrid', 'Rapidshare', 'C.Persuasino', 'Madrid', '34345', 'ESP', '¾enatý','ESP'),
								(603, 'Quinton', 'Aaron', 'obránce', '1984-8-15', 'CSK Nikol', 'Erfurt', 'Sparta', 'Martinsgasse', 'Erfurt', '35345', 'GER', 'svobodný','GER'),
								(604, 'Joss', 'Ackland', 'obránce', '1969-2-09', 'AC Milan', 'Londýn', 'Kotehulky', 'Moreton street', 'Londýn', '23343', 'ENG', '¾enatý', 'ENG');"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " HRAC.";
						echo "</h2>";
					}
					else
					{
						echo "<h2>HRAC ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}

					$query = mysql_query("INSERT INTO `SOUPISKA`
								(`ID_SOUPISKA`, `JMENO`,`ODEHRANY_CAS`, `HRAC_1`, `HRAC_2`, `HRAC_3`, `HRAC_4`, `HRAC_5`, `HRAC_6`, `HRAC_7`, `HRAC_8`, `HRAC_9`, `HRAC_10`, `HRAC_11`, `HRAC_12`, `HRAC_13`, `HRAC_14`, `HRAC_15`, `HRAC_16`) VALUES
								(1001, 'GER-ECU', 90, 600, 6001, 6002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1002, 'ECU-GER', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1003, 'ENG-SWE', 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1004, 'SWE-ENG', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1005, 'ARG-NED', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1006, 'NED-ARG', 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1007, 'PRT-MEX', 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1008, 'MEX-PRT', 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1009, 'FRA-ITA', 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
								(1010, 'ITA-FRA', 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " SOUPISKA.";
						echo "</h2>";
					}
					else
					{
						echo "<h2>";
						echo "SOUPISKA ";
						echo $text['insert_table'][ $_SESSION['lang']];
						echo "</h2>";
					}

					$query = mysql_query("INSERT INTO `ZAPAS`
								(ID_ZAPAS, DATUM, MISTO, DOMACI, HOSTE, VYSLEDEK, NASTAVENY_CAS, POCET_DIVAKU, TYP_ZAPASU, ROZ_HLAVNI, ROZ_POMEZ1, ROZ_POMEZ2, ROZ_POMOCNY, SOUPISKA1, SOUPISKA2, SKUPINA) VALUES
								(15, '1997-7-04 15:00:00', 'Westfalenstadion', 'GER', 'ECU', '4:2', 2, 45000, 'Skupina', 50, 51, 52, 53, 'GER-ECU', 'ECU-GER', 'A'),
								(11, '1997-6-06 15:00:00', 'Frankfurter Waldstadion', 'ENG', 'SWE', '0:0', 1, 62000, 'Skupina', 50, 51, 52, 53, 'ENG-SWE', 'SWE-ENG', 'B'),
								(12, '1997-6-07 15:00:00', 'Olympiastadion', 'ARG', 'NED', '2:1', 3, 70000, 'Skupina', 52, 50, 51, 53, 'ARG-NED', 'NED-ARG', 'C'),
								(13, '1997-6-08 15:00:00', 'Stuttgart', 'PRT', 'MEX', '4:1', 4, 53000, 'Skupina', 53, 51, 52, 50, 'PRT-MEX', 'MEX-PRT', 'D'),
								(14, '1997-6-21 15:00:00', 'Berlin', 'FRA', 'ITA', '3:2', 6, 73000, 'finale', 52, 53, 50, 51, 'FRA-ITA', 'ITA-FRA', NULL);"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>";
						echo $text['not_insert_table'][ $_SESSION['lang']];
						echo " ZAPAS.";
						echo "</h2>";
					}
					else
					{
						echo "<h2> ZAPAS ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}
					$query = mysql_query("INSERT INTO `AKCE` (ID_AKCE, MINUTA, TYP_AKCE, HRAC, ZAPAS) VALUES
								(91, 30, 'gol', 603, 11),
								(92, 40, 'zluta karta', 600, 11),
								(93, 67, 'gol', 601, 12),
								(94, 5, 'faul', 602, 13);"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." AKCE.</h2>";
					}
					else
					{
						echo "<h2>AKCE ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}

					$query = mysql_query("INSERT INTO `ODEHRANY_CAS` (`ID_ODE_CAS`, `OD`, `D0_C`, `HRAC`, `ZAPAS`) VALUES
								(81, 0, 34, 600, 11),
								(82, 0, NULL, 601,14),
								(83, 34, NULL, 602,11);"
								);
					if( !$query )
					{
						$create = FALSE;
						echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." ODEHRANY_CAS.</h2>";
					}
					else
					{
						echo "<h2>ODEHRANY_CAS ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
					}
				}
			}
			else	// neni zmackle tlacitko install
			{
				echo "<h2>".$text['system_name'][$_SESSION['lang']]."</h2>

					 <h4 class='instal'>".$text['author'][ $_SESSION['lang']]."</h4>
					 <ul class='instal'>
						<li>".$text['xsendl00'][ $_SESSION['lang']]."</li>
						<li>".$text['xkovac21'][ $_SESSION['lang']]."</li>
					 </ul>

					 <h2>".$text['system_install'][ $_SESSION['lang']]."</h2>
					 <form action='install.php' method='POST' >
						".$text['system_lang_cz'][$_SESSION['lang']]."
						<input type='submit' value='".$languageCz."' name='souhlas'>
						".$text['system_lang_eng'][$_SESSION['lang']]."
						<input type='submit' value='".$languageEng."' name='souhlas'>
					 </form>
				";
			}
         require_once('show_head.php');
   require_once('head.php');
		?>
