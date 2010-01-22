<?php

   include 'default.php';
   $file = $files["connect"];
   require_once ("$file");
   $file = $files['common'];
   require_once ("$file");

   session_name('RT_kontext');
   session_start();

   $_SESSION['lang'] = 0;
   $error[]=array();
   $error['name']="";
   $error['surname']="";
   $error['date']="";
   $error['home_club']="";
   $error['hometown']="";
   $error['last_club']="";
   $error['street']="";
   $error['city']="";
   $error['zip']="";
   $error['state']="";
   $error['team']="";
   $error['user']="";
   $error['family']="";
   $error['pozicion']="";


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $languageCz
    * @global <type> $files
    * @param <type> $file
    * @param <type> $name
    * @param <type> $surname
    * @param <type> $date
    * @param <type> $home_club
    * @param <type> $hometown
    * @param <type> $last_club
    * @param <type> $street
    * @param <type> $city
    * @param <type> $zip
    * @param <type> $state
    */
   function writeFormPlayer($file, $name, $surname, $date, $home_club, $hometown, $last_club, $street, $city, $zip, $state) {
      global $error;
      global $text;
      global $languageCz;
      global $files;

      echo "
      <div class=\"formular\">
         <form action=".$files["addPlayer"]." method=post>
            <table>
               <h4><font color=red>".$error['user']."</font></h4>
                <h4>".$text['add_player'][$_SESSION['lang']]."</h4>
               <tr><td>".$error['name']."</td> </tr>
              <tr> <td><b><font color=red>".$text['f_name'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='name' value=\"".$name."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['surname']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_surname'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='surname' value=\"".$surname."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['pozicion']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_player_pozicion'][$_SESSION['lang']]."</font></b></td> <td>" ; echo callDropdownPozicion()."</td></tr>
              <tr><td>".$error['date']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_date'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['home_club']." </td></tr>
              <tr> <td><b>".$text['f_home_club'][$_SESSION['lang']]."</b></td> <td><input type='text' name='home_club' value=\"".$home_club."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['last_club']."</td></tr>
              <tr> <td><b>".$text['f_last_club'][$_SESSION['lang']]."</b></td> <td><input type='text' name='last_club' value=\"".$last_club."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['hometown']."</td></tr>
              <tr> <td><b><font color=red>".$text['f_hometown'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='hometown' value=\"".$hometown."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['family']."</td></tr>
              <tr> <td><b><font color=red>".$text['f_family'][$_SESSION['lang']]."</font></b></td> <td> ";echo callDropdownFamily()."</td></tr>
               <tr><td>".$error['street']."</td></tr>
               <tr> <td><b>".$text['f_street'][$_SESSION['lang']]."</b></td> <td><input type='text' name='street' value=\"".$street."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['city']."</td></tr>
               <tr> <td><b>".$text['f_city'][$_SESSION['lang']]."</b></td> <td><input type='text' name='city' value=\"".$city."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['zip']."</td></tr>
               <tr> <td><b>".$text['f_zip'][$_SESSION['lang']]."</b></td> <td><input type='text' name='zip' value=\"".$zip."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['state']."</td></tr>
               <tr> <td><b>".$text['f_state'][$_SESSION['lang']]."</b></td> <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['team']."</td></tr>
               <tr> <td><b><font color=red>".$text['f_team'][$_SESSION['lang']]."</font></b></td> <td> "; echo fillDropdownTeam()."</td></tr>
            </table><br>
               <input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
         </form>
      </div>
         ";
   }


   /**
    *
    * @global <type> $text
    * @global <type> $defaultLanguage
    */
   function callDropdownPozicion() {

      global $text;
      global $defaultLanguage;
      $pairs[$text['f_goalkeeper'][$defaultLanguage]] = $text['f_goalkeeper'][$defaultLanguage];
      $pairs[$text['f_defenders'][ $defaultLanguage]] = $text['f_defenders'][ $defaultLanguage];
      $pairs[$text['f_midfielders'][$defaultLanguage]] = $text['f_midfielders'][$defaultLanguage];
      $pairs[$text['f_forward'][$defaultLanguage]] = $text['f_forward'][$defaultLanguage];

      if( empty($_POST))
            echo createDropdown("pozicion", $pairs, "---", "---");
         else
            echo createDropdown("pozicion", $pairs, "---", $_POST["pozicion"]);
   }


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $defaultUser
    * @global <type> $czechWord
    * @global <type> $file
    */
   function checkForm() {

      global $error;
      global $text;
      global $defaultUser;
      global $czechWord;
      global $file;

      if( empty($_POST) )
      {
          writeFormPlayer($file, "","","","","","","","","", "");
      }
      else
      {
         checkNameM();                 //kontrola jmena
         checkSurnameM();              //kontrola prijmeni
         checkDateM();                 //kontrola datumu narozeni
         checkHometownM();             //kontrola rodiste
         checkStreet();                //kontrola ulice
         checkCity();                  //kontrola mesta
         checkZipM();                  //kontrola ZIP
         checkStateM();                //kontrola statu
         checkFamilyM();               //kontrola rodinneho stavu
         checkPozicionM();             //kontrola pozice
         checkTeamM();                 //kontrola tymu
         checkHomeClub();              //kontrola domaciho klubu
         checkLastClub();              //kontrola byvaleho klubu

      // tisk formulare
         if( !$error["name"]=="" || !$error["surname"]=="" || !$error["date"]=="" || !$error["home_club"]==""
            || !$error["hometown"]=="" || !$error["last_club"]=="" || !$error["street"]=="" || !$error["city"]==""
            || !$error["zip"]=="" || !$error["state"]=="" || !$error["team"]=="" || !$error["family"]==""
            || !$error["pozicion"]==""	)
         {
            writeFormPlayer($file, $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["home_club"], $_POST["hometown"],
                     $_POST["last_club"], $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]); //odebran $_POST["team"]
         }
         else
         {
            $query=mysql_query("SELECT * FROM `HRAC` WHERE jmeno='".$_POST["name"]."' and
                                                           prijmeni='".$_POST["surname"]."';");

            if( mysql_num_rows($query) != 0 )	// hrac je jiz v databazi
            {
              $error["user"] = $text['no_user'][ $_SESSION['lang']];
              $_POST["name"] = "";
              $_POST["surname"] = "";
              checkFormPlayer();
            }
            else	// hrac neni v databazi
            {
               $quastion = "INSERT INTO `HRAC`
                           (JMENO, PRIJMENI, HRACI_POZICE, DATUM_NAROZENI, DOMOVSKY_KLUB, RODISTE, BYVALY_KLUB, ULICE, MESTO, ZIP, STAT, RODINNY_STAV, TYM) VALUES
                           ('".$_POST["name"]."', '".$_POST["surname"]."', '".$_POST["pozicion"]."', '".$_POST["date"]."', '".$_POST["home_club"]."', '".$_POST["hometown"]."', '".$_POST["last_club"]."', '".$_POST["street"]."', '".$_POST["city"]."', '".$_POST["zip"]."', '".strtoupper($_POST["state"])."', '".$_POST["family"]."', '".strtoupper($_POST["team"])."');";

               $error["user"] = "";
               $query = mysql_query($quastion);

               if( !$query )
               {
                  echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." HRAC.</h2>";
               }
               else
               {
                  echo "<h2>HRAC ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
               }
            }
         }
      }
   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   $file = $files['rule'];
   require_once ("$file");

?>