<?php
/*
 * Seznam vsech pouzitych textu v informacnim systemu
 *
 */
$text = array (

	'no_query'						=>			array('�patn� sql dotaz.',
															'Bad SQL query.'),
	'table_full'					=>			array('Chyba dat.',
															'Eror od data'),
	// install.php
	'not_create_table'			=>			array('Nelze vytvo�it tabulku:',
															'Can not create table:'),
	'create_table'					=>			array('Tabulka vytvo�ena.',
															'Table created.'),
	'n_create'						=>			array('Vytvo�� se tabulky.',
															'Tables will be created.'),
	'n_insert'						=>			array('Napln� se vytvo�en� tabulky vzorem dat.',
															'Fill table sample of data.'),
	'not_insert_table'			=>			array('Nepovedlo se naplnit tabulku:',
															'Table is not filled:'),
	'insert_table'					=>			array('Tabulka je napln�na daty.',
															'Table is filled by data.'),
	'author'							=>			array('Auto�i:',
															'Authors:'),
	'system_name'					=>			array('Instalace syst�mu RT-Mistrostv� sv�ta ve fotbalu.',
															'Instalall system RT-FIFA World Cup.'),
	'system_install'				=>			array('Instalace:',
															'Install:'),
	'system_lang_cz'				=>			array('�esky:',
															'Czech:'),
	'system_lang_eng'				=>			array('Anglicky:',
															'English:'),
	'xsendl00'						=>			array('Jaroslav Sendler - xsendl00.',
															'Jaroslav Sendler - xsendl00.'),
	'xkovac21'						=>			array('Du�an Kova�i� - xkovac21.',
															'Dusan Kovacic - xkovac21'),

	// login.php
	'empty_login'					=>			array('Nezad�n login.',
															'Empty login.'),
	'empty_password'				=>			array('Nezad�no heslo.',
															'Empty password.'),
	'no_enter'						=>			array('P��stup  odep�en.',
															'No enter'),
	'no_enter1'						=>			array('Zadal jste �patn� heslo nebo p�ihla�ovac� jm�no',
															'Bad login or name'),
	// add_user.php
	'send_buttom'					=>			array('Odeslat',
															'Send'),
	'no_name'						=>			array('Zadejte jm�no.',
															'Enter name.'),
	'no_name1'						=>			array('Jm�no nesm� obsahovat b�l� znaky.',
															'Name must not include white signs.'),
	'no_name2'						=>			array('D�lka jm�na mus� b�t v intervalu 2-45 znak�.',
															'Length of name must be in interval 2-45 symbols.'),
	'no_name3'						=>			array('P�ihla�ovac� jm�no je ji� v datab�zi, pou�ijte jin�.',
															'Entry name is in database now, use different.'),
	'no_surname'					=>			array('Zadejte p��jmen�.',
															'Enter name.'),
	'no_surname1'					=>			array('P��jmen� nesm� obsahovat b�l� znaky.',
															'Surname must not include white signs.'),
	'no_surname2'					=>			array('D�lka p��jmen� mus� b�t v intervalu 2-45 znak�.',
															'Length of surname must be in interval 2-45 symbols.'),
	'no_surname3'					=>			array('P��jmen� je ji� v datab�zi, pou�ijte jin�.',
															'Surname is in database now, use different.'),
	'no_login'						=>			array('Zadejte p�ihla�ovac� jm�no.',
															'Enter the entry name.'),
	'no_login1'						=>			array('P�ihla�ovac� jm�no nesm� obsahovat b�l� znaky.',
															'Entry name must not include white signs.'),
	'no_login2'						=>			array('D�lka p�ihla�ovac�ho jm�na mus� b�t v intervalu 2-20 znak�.',
															'Lenght entry name must be in interval 2-20 symbols.'),
	'no_login3'						=>			array('P�ihla�ovac� jm�no nesm� obsahovat �esk� znaky.',
															'Entry name must not include czech symbols.'),
	'no_login4'						=>			array('P�ihla�ovac� jm�no je ji� v datab�zi, pou�ijte jin�.',
															'Entry name is in database now, use different.'),
	'no_pass'						=>			array('Zadejte p�ihla�ovac� heslo.',
															'Enter password.'),
	'no_pass1'						=>			array('P�ihla�ovac� heslo nesm� obsahovat b�l� znaky.',
															'Entry password must not include white signs. '),
	'no_pass2'						=>			array('D�lka p�ihla�ovac�ho hesla mus� b�t v intervalu 4-20 znak�.',
															'Lenght entry password must be in interval 4-20 symbols.'),
	'no_pass3'						=>			array('P�ihla�ovac� heslo nesm� obsahovat �esk� znaky.',
															'Entry password must not include czech signs.'),
	'no_email'						=>			array('E-mail nesm� b�t pr�zdn�.',
															'E-mail must not be empty.'),
	'no_email1'						=>			array('E-mail je ve tvaru xx@xx.xx.',
															'E-mail must be xx@xx.xx.'),
	'no_email2'						=>			array('D�lka e-mailu nesm� b�t del�� ne� 100 znak�.',
															'Lenght of e-mail must not be longer than 100 symbols.'),
	'no_email3'						=>			array('E-mail nesm� obsahovat �esk� znaky.',
															'E-mail must not include czech signs. '),
	'f_name'							=>			array('Jm�no:',
															'Name:'),
	'f_surname'						=>			array('P��jmen�:',
															'Surname:'),
	'f_login'						=>			array('P�ihla�ovac� jm�no:',
															'Login:'),
	'f_pass'							=>			array('Heslo:',
															'Password:'),
	'f_old'							=>			array('V�k:',
															'Age:'),
	'f_email'						=>			array('E-mail:',
															'E-mail:'),
// add_player.php
	'add_player'					=>			array('Pros�m, vypl�te n��e uveden� �daje pro p�id�n� Hr��e: <font color=red>�erven� pole</font> jsou povinn�.',
															'Please, fill data for addition player:'),
	'f_player_pozicion'			=>			array('Hrac� pozice:',
															'Player pozition:'),
	'f_date'							=>			array('Datum narozen� (rrrr-mm-dd):',
															'Date birthday (rrrr-mm-dd):'),
	'f_home_club'					=>			array('Dom�c� klub:',
															'Home club:'),
	'f_hometown'					=>			array('Rodi�t�:',
															'Hometown:'),
	'f_last_club'					=>			array('Minul� klub:',
															'Last club:'),
	'f_street'						=>			array('Ulice:',
															'Street:'),
	'f_city'							=>			array('M�sto:',
															'City:'),
	'f_zip'							=>			array('PS�:',
															'Zip:'),
	'f_state'						=>			array('St�t:',
															'State:'),
	'f_family'						=>			array('Rodinn� stav:',
															'Marital status:'),
	'f_team'							=>			array('T�m:',
															'Team:'),
				//dropdown
	'f_goalkeeper'					=>			array('brank��',
															'goalkeeper'),
	'f_defenders'					=>			array('obr�nce',
															'defenders'),
	'f_midfielders'				=>			array('z�lo�n�k',
															'midfielders'),
	'f_forward'						=>			array('�to�n�k',
															'forward'),
	'no_pozicion'					=>			array('Vyberte pozici hr��e:',
															'Choose player position:'),
	'no_family'						=>			array('Vyberte rodinn� stav:',
															'Choose marital status:'),
	'no_date'						=>			array('Polo�ka datum nesm� b�t pr�zdn�.',
															'Date must not be empty.'),
	'no_date1'						=>			array('Zadali jste �patn� form�t data, mus� b�t rok-m�s�c-den.',
															'Wrong format of date, must be year-month-day.'),
	'no_date2'						=>			array('Zadali jste �patn� form�t data, mus� b�t (1900-2000)-(1-12)-(1-31).',
															'Wrong format of date, must be (1900-2000)-(1-12)-(1-31).'),
	'no_home_club'					=>			array('N�zev dom�c�ho klubu mus� b�t krat�� jak 40 znak�.',
															'Name of home club must be shorter than 40 symbols.'),
	'no_hometown'					=>			array('Rodi�t� nesm� b�t pr�zdn�.',
															'Hometown must not be empty.'),
	'no_hometown1'					=>			array('Rodi�t� mus� b�t krat�� jak 25 znak�.',
															'Hometown must be shorter than 25 symbols.'),
	'no_last_club'					=>			array('N�zev b�val�ho klub mus� b�t krat�� jak 25 znak�.',
															'Name of last club must be shorter than 25 symbols.'),
	'no_street'						=>			array('Ulice mus� b�t krat�� jak 20 znak�.',
															'Street must be shorter than 20 symbols.'),
	'no_city'						=>			array('M�sto mus� b�t krat�� jak 15 znak�.',
															'City must be shorter than 15 symbols.'),
	'no_zip'							=>			array('PS� mus� b�t 4-5 znak� dlouh� a to jen ��slice.',
															'Zip must be longer 4-5 symbols and only numbers.'),
	'no_state'						=>			array('Zkratka st�tu mus� m�t d�lku 2-3 znaky.',
															'Short cut of state must be longer 2-3 symbols.'),
					//dropdown
	'f_unmarried'					=>			array('svobodn�',
															'unmarried'),
	'f_married'						=>			array('�enat�',
															'married'),
	'f_divorced'					=>			array('rozveden�',
															'divorced'),
	'f_widower'						=>			array('vdovec',
															'widower'),
	'no_team'						=>			array('T�m nesm� b�t pr�zdn�.',
															'Team must not be empty.'),
	'no_team3'						=>			array('Dom�c� a host� nem� b�t stejn�.',
															'HOST x HOME.'),
	'no_team1'						=>			array('Zkratka t�mu mus� b�t v rozmez� 2-3 znaky.',
															'Short cut of team must be longer 2-3 symbols.'),
	'no_team2'						=>			array('Zkratka t�mu nesm� obsahovat �esk� znaky.',
															'Short of team must not include czech signs.'),
	'no_user'						=>			array('Hr�� je ji� v datab�zi, zadejte jin� jm�no a p��jmen�.',
															'Player is in database now, enter different name and surname.'),
// add_referee.php
	'add_referee'					=>			array('Pros�m, vypl�te n��e uveden� �daje pro p�id�n� rozhod��ho. <font color=red>�erven� pole</font> jsou povinn�.',
															'Referee position:'),
	'no_referee'					=>			array('Rozhod�� je ji� v datab�zi, zadejte jin� jm�no a p��jmen�.',
															'No czech char.'),
// add_team.php
	'add_team'						=>			array('Pros�m, vypl�te n��e uveden� �daje pro p�id�n� t�mu. <font color=red>�erven� pole</font> jsou povinn�.',
															'Please, fill data for addition team:'),
	'no_team_add'					=>			array('T�m je ji� v datab�zi, zadejte jinou zkratku t�mu a p��padn� i n�zev.',
															'No czech char.'),
	'no_team_add1'					=>			array(' Vybran� tabulka pro t�m je ji� pln�, pou�ijte jinou tabulku.',
															'No czech char.'),
	'no_code'						=>			array('Zkratka t�mu nem� b�t pr�zdn�.',
															'No empty'),
	'no_code1'						=>			array('D�lka zkratky t�mu mus� b�t v intervalu 2-3.',
															'2-3.'),
	'no_code2'						=>			array('Zkratka t�mu nesm� obsahovat �esk� znaky ani ��slice.',
															'No czech char.'),
	'no_state1'						=>			array('N�zev t�mu nesm� b�t pr�zdn�.',
															'25.'),
	'no_state2'						=>			array('D�lka t�mu mus� b�t krat�� jak 25.',
															'No czech char.'),
	'no_slogan'						=>			array('D�lka sloganu mus� b�t krat�� jak 150.',
															'< 150.'),
	'no_group'						=>			array('Vyberte skupinu.',
															'Choose group.'),
	't_code'							=>			array('Zkratka st�tu:',
															'Code state:'),
	't_state'						=>			array('N�zev st�tu:',
															'State name:'),
	't_slogan'						=>			array('Slogan:',
															'Slogan:'),
	't_group'						=>			array('Skupina:',
															'Group:'),

	// add_match.php
	'match'							=>			array('Z�pas je ji� v datab�zi.',
															'Match is in database now.'),
	'add_match'						=>			array('Pros�m, vypl�te n��e uveden� �daje pro p�id�n� z�pasu. <font color=red>�erven� pole</font> jsou povinn�.',
															'Please, fill data for addition match.'),
	't_state'						=>			array('N�zev st�tu:',
															'State name:'),
	't_slogan'						=>			array('Slogan:',
															'Slogan:'),
	't_date'							=>			array('Datum z�pasu (rrrr-mm-dd xx:xx):',
															'Date of match (yyyy-mm-dd xx:xx):'),
	't_type'							=>			array('Typ z�pasu:',
															'Type of match:'),
	't_place'						=>			array('M�sto z�pasu:',
															'Place of match:'),
	't_score'						=>			array('Sk�re:',
															'Score:'),
	'f_referee'						=>			array('Pomocn� rozhod��:',
															'Help referee:'),
	'f_referee2'					=>			array('Hlavn� rozhod��:',
															'Main referee:'),
	'f_referee3'					=>			array('1.Pomezn� rozhod��:',
															'Referee 1:'),
	'f_referee4'					=>			array('2.Pomezn� rozhod��:',
															'Referee 2:'),
	't_list'							=>			array('Soupiska dom�c�ch:',
															'Home\'s list:'),
	't_list2'						=>			array('Soupiska host�:',
															'Guest\'s list:'),
	'no_referee'					=>			array('Vyberte rozhod��ho:',
															'Choose referee:'),
	't_over_time'					=>			array('Nastaven�:',
															'Over time:'),
	't_people'						=>			array('Po�et div�ku:',
															'Number of watchers:'),
	'no_over_time'					=>			array('Nastaven� �as mus� obsahovat jen ��sla a nesm� za��nat 0.',
															'Over time must include only number and must not start by 0.'),
	'no_over_time1'				=>			array('Nastaven� �as mus� b�t men�� ne� 20.',
															'Over time must be shorter than 20.'),
	'no_people'						=>			array('Po�et div�ku obsahuje jen znaky 0-9.',
															'Only 0-9 char.'),
	'no_people1'					=>			array('Po�et div�ku nesm� b�t v�t�� jak 200 000,',
															'Number of watchers must not be bigger than 200 000.'),
	'no_type'						=>			array('Vyberte typ z�pasu:',
															'Choose type of match:'),
	'no_score'						=>			array('V�sledek z�pasu mus� b�t ve tvaru xx:xx :',
															'Result of match must be xx:xx :'),
	'no_score1'						=>			array('V�sledek z�pasu mus� b�t ve tvaru xx:xx :',
															'Result of match must be xx:xx :'),
	'no_place'						=>			array('M�sto kon�n� z�pasu nesm� b�t pr�zdn� :',
															'Place of match must not be empty:'),
	'no_place1'						=>			array('M�sto z�pasu nesm� b�t del�� jak 25 znak�.',
															'Place of match must not be longer than 25 symbols.'),
	'no_list'						=>			array('Soupisky mu�stev nesm� b�t stejn�.',
															'List must be diffrent.'),
	// add_action.php
	'no_minute'						=>			array('Minuta nesm� b�t prazdn�.',
															'Minute must not be empty.'),
	'no_minute2'					=>			array('Jen ��sla.',
															'Only number.'),
	'no_minute3'					=>			array('Minuta maximalne 120.',
															'Max 120.'),
	'no_player'						=>			array('Vyberte hr��e.',
															'Choose player.'),
	'no_action'						=>			array('Vyberte akci.',
															'Choose action.'),
	'no_team5'						=>			array('Vyberte t�m.',
															'Choose team.'),
	'add_action'						=>			array('Pros�m, vypl�te n��e uveden� �daje pro p�id�n� Akce: <font color=red>�erven� pole</font> jsou povinn�.',
															'Please, fill data for addition action:'),
	'f_y_card'						=>			array('�lut� karta',
															'yellow card'),
	'f_r_card'						=>			array('�erven� karta',
															'red card'),
	'f_foul'							=>			array('faul',
															'foul'),
	'f_own_goal'					=>			array('vlastn� g�l',
															'own goal'),
	'f_goal'							=>			array('g�l',
															'goal'),
	'f_corner'						=>			array('rohov� kop',
															'corner kick'),
	'f_out'							=>			array('autov� vhazov�n�',
															'out'),
	'f_penalty'						=>			array('penalta',
															'penalty'),
	'f_offside'						=>			array('ofsajd',
															'offside'),
	'f_player'						=>			array('Hr��:',
															'Player:'),
	'f_match_type'					=>			array('Akce:',
															'Action:'),
	'f_minute'						=>			array('Minuta:',
															'Minute:'),
	'f_match'						=>			array('Z�pas:',
															'Match:'),
	// default.php
	'no_escort'						=>			array('�len doprovodn�ho t�mu je ji� v datab�zi.',
															'Member of escort team is in database now.'),
	'add_escort'					=>			array('Pros�m, vypl�te n��e uveden� �daje pro p�id�n� �lena do doprovodn�ho t�mu. <font color=red>�erven� pole</font> jsou povinn�.',
															'Please, fill data for addition member for escort team:'),
	'f_escort_pozicion'			=>			array('Pozice v t�mu:',
															'Team position:'),
						//dropdown
	'f_coach'						=>			array('tren�r',
															'coach'),
	'f_assistant'					=>			array('asistent',
															'assistant'),
	'f_doctor'						=>			array('doktor',
															'doctor'),
	'f_maser'						=>			array('mas�r',
															'massager'),
	'f_group'						=>			array('skupina',
															'group'),
	'f_quarterfinal'				=>			array('�tvrtfin�le',
															'quarterfinal'),
	'f_eightfinal'					=>			array('osmi fin�le',
															'eightfinal'),
	'f_semifinal'					=>			array('semifin�le',
															'semifinal'),
	'f_final'						=>			array('fin�le',
															'final'),
   'f_guest_club' => array('Host�:',
                               'Guest:'),
                                  // show_teams_new.php
   's_teams'      				 =>         array('Seznam t�m�',
																'Teams'),
   's_code'      					 =>         array('Kod z�me',
																'Code of country'),
   's_stat'       				=>          array('St�t',
																'Country'),
   's_skupina'      				 =>         array('Skupina',
																'Group'),
    // show_actions_new.php
   's_actions'   					 =>     		 array('Seznam akc�',
																'Actions'),
   's_zapas' 						=>           array('Z�pas',
																'Match'),
   's_typ' 							=>           array('Typ akce',
																'Type of action'),
   's_minuta' 						=>           array('Minuta',
																'Minute'),
   's_hrac'							=>           array('Hr��',
																'Player'),
   's_id'							=>           array('Id',
																'Id'),
    //show groups
    's_skA'							=>   			array('Skupina A','Group A'),
    's_skB'							=>   			array('Skupina B','Group B'),
    's_skC'							=> 		  	array('Skupina C','Group C'),
    's_skD'							=>   			array('Skupina D','Group D'),
    's_skE'							=>   			array('Skupina E','Group E'),
    's_skF'							=>   			array('Skupina F','Group F'),
    's_skG'							=>   			array('Skupina G','Group G'),
    's_skH'							=>   			array('Skupina H','Group H'),
    's_mesto'						=> 			array('Mesto: ','City: '),
    's_tym1'						=> 			array('T�m 1: ','Team 1: '),
    's_tym2'						=> 			array('T�m 2: ','Team 2: '),
    's_tym3'						=> 			array('T�m 3: ','Team 3: '),
    's_tym4'						=> 			array('T�m 4: ','Team 4: '),
	// players
	  's_meno'						=> 			array('Jm�no','Name'),
	  's_priezv'					=> 			array('P�ijmen�','Surename'),
	  's_pozicia'					=> 			array('Pozice','Position'),
	  's_domklub'					=> 			array('Dom�c� klub','Home club'),
    's_team'						=> 			array('T�m','Team'),
    's_hraci'						=> 			array('Seznam hr���','List of players'),
    's_edit'						=> 			array('Edituj','Edit'),
    's_editplayer'				=> 		array('Edituj hr��e','Edit players'),
    's_ref'                =>   array('Edituj rozhod��','Edit referees'),
    's_editteams' => array('Edituj t�my','Edit teams'),
    's_refshow' => array('Seznam rozhod��','List of referees'),
    //match
    's_date' =>  array('Datum','Date'),
    's_home' =>  array('Dom�ci','Home'),
    's_guest' => array('Host�','Guest'),
    's_score' => array('Sk�re','Score'),
    's_type' => array('Typ z�pasu','Type of match'),
    's_time' => array('�as','Time'),
    's_people' => array('Lid�','People'),
    's_ref1' => array('Hlavn� rozhod��','Referee 1'),
    's_ref2' => array('Pomezn� rozhod��','Referee 2'),
    's_ref3' => array('Pomezn� rozhod��','Referee 3'),
    's_ref4' => array('Pomocn� rozhod��','Referee 4'),
	's_zapshow'=> array('Seznam z�pas�','List of matches'),
	 's_zapedit' => array('Edituj z�pasy','Edit matches'),
	 's_akcedit' => array('Edituj akce','Edit actions'),
    's_dopredit' => array('Edituj doprovodn� t�m','Edit escort team'),
    's_dopshow' => array('Doprovodn� t�my','Escort teams'),
	// tabulka

    's_menu' => array('
        <div class="hlavicka">
				<div class="menu_top">
				<ul id="top">
					<li><a class="link01" href="show_teams_new.php">T�my</a>
					<ul class="submenu_top type02">
							<li><a class="active podkat" href="add_team_new.php">Pridat t�m</a></li>
							<li><a class="podkat" href="edit_team_new.php">Editovat t�m</a></li>
						</ul>
					</li>
					<li><a class="link01" href="show_players_new.php">Hr��i</a>
					<ul class="submenu_top type02">
							<li><a class="active podkat" href="add_player_new.php">Pridat hr��e</a></li>
							<li><a class="podkat" href="edit_player_new.php">Editovat hr��e</a></li>
						</ul>
					</li>
					<li><a class="link01" href="#">Skupiny</a>
						<ul class="submenu_top type02">
							<li><a class="podkat" href="show_skupina_A.php">Skupina A</a></li>
							<li><a class="podkat" href="show_skupina_B.php">Skupina B</a></li>
							<li><a class="podkat" href="show_skupina_C.php">Skupina C</a></li>
							<li><a class="podkat" href="show_skupina_D.php">Skupina D</a></li>
							<li><a class="podkat" href="show_skupina_E.php">Skupina E</a></li>
							<li><a class="podkat" href="show_skupina_F.php">Skupina F</a></li>
							<li><a class="podkat" href="show_skupina_G.php">Skupina G</a></li>
							<li><a class="podkat" href="show_skupina_H.php">Skupina H</a></li>
						</ul>
					</li>
					<li><a class="link01" href="show_referees_new.php">Rozhod��</a>
						<ul class="submenu_top type02">
							<li><a class="active podkat" href="add_referee_new.php">Pridat rozhod��</a></li>
							<li><a class="podkat" href="edit_referee_new.php">Editovat rozhod��</a></li>
						</ul>
					</li>
					<li><a class="link01" href="show_actions_new.php">Akce</a>
						<ul class="submenu_top type02">
							<li><a class="active podkat" href="add_action_new.php">Pridat akci</a></li>
							<li><a class="podkat" href="edit_action_new.php">Editovat akci</a></li>
						</ul>
					</li>
					<li><a class="link01" href="show_match_new.php">Z�pasy</a>
						<ul class="submenu_top type02">
							<li><a class="active podkat" href="add_match_new.php">Pridat z�pas</a></li>
							<li><a class="podkat" href="edit_match_new.php">Editovat z�pas</a></li>
						</ul>
					</li>
					<li><a class="link01" href="#">Statistika</a>
						<ul class="submenu_top type02">
							<li><a class="podkat" href="#">Nejlep�� strelci</a></li>
							<li><a class="podkat" href="#">Nejv�c karet</a></li>
						</ul>
					</li>
					<li><a class="link01" href="#">Data</a>
					<ul class="submenu_top type02">
							<li><a class="active podkat" href="import_new.php">Import</a></li>
							<li><a class="podkat" href="export_new.php">Export</a></li>
						</ul>
					</li>
					
					<li><a class="link01" href="show_escort_new.php">Doprovodn� t�m</a>
					<ul class="submenu_top type02">
							<li><a class="active podkat" href="add_escort_new.php">Pridat doprovodn� t�m</a></li>
							<li><a class="podkat" href="edit_escort_new.php">Editovat doprovodn� t�m</a></li>
						</ul>
					</li>
					<li><a class="link01" href="add_user.php">Registrovat</a></li>
					<li><a class="link01" href="logout.php">Log out</a></li>
				</ul>
				</div>
			</div>
		</div>
    </br>
    </br>
    </br>','xxxxx'),
	// tymy

	// .....


'sentinel'           			 =>      	array('',''));
?>