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
    * @param <type> $id
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
   function writeFormPlayer($file, $id, $name, $surname, $date, $home_club, $hometown, $last_club, $street, $city, $zip, $state) {
      global $error;
      global $text;
      global $languageCz;
      global $files;

      echo "
         <div class=\"formular\">
            <form action=".$files["editPlayer"]." method=post>
            <h2><font color=red>".$error['user']."</font></h2>
            <h2>".$text['add_player'][$_SESSION['lang']]."</h2>
            <table>

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
               <input type='hidden' name='check' value='true'>
               <input type='hidden' name='id_player' value=\"".$id."\"'>
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
   function checkForm(  ) {
      global $error;
      global $text;
      global $defaultUser;
      global $czechWord;
      global $file;

      if( $_POST["check"]=='false' )
      {
         editPlayer();
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
            writeFormPlayer($file,$_POST["id_player"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["home_club"], $_POST["hometown"],
                     $_POST["last_club"], $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]); //odebran $_POST["team"]
         }
         else
         {
            $quastion = "UPDATE `HRAC` SET `JMENO`='".$_POST["name"]."', `PRIJMENI`='".$_POST["surname"]."', `HRACI_POZICE`='".$_POST["pozicion"]."', `DATUM_NAROZENI`='".$_POST["date"]."', `DOMOVSKY_KLUB`='".$_POST["home_club"]."',
                        `RODISTE`='".$_POST["hometown"]."', `BYVALY_KLUB`='".$_POST["last_club"]."', `ULICE`='".$_POST["street"]."', `MESTO`='".$_POST["city"]."', `ZIP`='".$_POST["zip"]."', `STAT`='".strtoupper($_POST["state"])."', `RODINNY_STAV`='".$_POST["family"]."', `TYM`='".StrToUpper($_POST["team"])."'
                        WHERE `ID_HRAC`='".$_POST["id_player"]."';";

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


   /**
    *
    * @global <type> $file 
    */
   function editPlayer() {

      global $file;
      $edit_player[]=array();

      $edit_player["name"]=$_POST["name"];
      $edit_player["surname"]=$_POST["surname"];
      $edit_player["team"]=$_POST["team"];
      $query=mysql_query("SELECT * FROM `HRAC` WHERE JMENO='".$edit_player["name"]."' and PRIJMENI='".$edit_player["surname"]."' and TYM='".$edit_player["team"]."';");

      if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
      {
         echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
      }
      else
      {
         $row = mysql_fetch_array($query);

         $edit_player["id"] = $row["ID_HRAC"];
         $edit_player["name"]=$row["JMENO"];
         $edit_player["surname"]=$row["PRIJMENI"];
         $edit_player["pozicion"]=$row["HRACI_POZICE"];
         $edit_player["date"]=$row["DATUM_NAROZENI"];
         $edit_player["home_club"]=$row["DOMOVSKY_KLUB"];
         $edit_player["hometown"]=$row["RODISTE"];
         $edit_player["last_club"]=$row["BYVALY_KLUB"];
         $edit_player["street"]=$row["ULICE"];
         $edit_player["city"]=$row["MESTO"];
         $edit_player["zip"]=$row["ZIP"];
         $edit_player["state"]=$row["STAT"];
         $edit_player["family"]=$row["RODINNY_STAV"];
         $edit_player["team"] =$row["TYM"];
      }
      writeFormPlayer($file,$edit_player["id"], $edit_player["name"],$edit_player["surname"],$edit_player["date"],$edit_player["home_club"],
                     $edit_player["hometown"],$edit_player["last_club"],$edit_player["street"],$edit_player["city"],$edit_player["zip"], $edit_player["state"]);

   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   checkForm();
   
?>