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
   $error['escort']="";
   $error['family']="";
   $error['pozicion']="";


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $languageCz
    * @param <type> $id
    * @param <type> $name
    * @param <type> $surname
    * @param <type> $date
    * @param <type> $hometown
    * @param <type> $street
    * @param <type> $city
    * @param <type> $zip
    * @param <type> $state
    */
   function writeFormEscort($id, $name, $surname, $date, $hometown, $street, $city, $zip, $state) {
      global $error;
      global $text;
      global $languageCz;

      echo "
         <form action=".$files["editTeamEscort"]." method=post>
         <fieldset>
            <h2><font color=red>".$error['escort']."</font></h2>
            <h2>".$text['add_escort'][$_SESSION['lang']]."</h2>
            <table>
               <tr><td>".$error['name']."</td> </tr>
              <tr> <td><b><font color=red>".$text['f_name'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='name' value=\"".$name."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['surname']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_surname'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='surname' value=\"".$surname."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['date']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_date'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
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
                  <tr><td>".$error['pozicion']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_escort_pozicion'][$_SESSION['lang']]."</font></b></td> <td>" ; echo callDropdownPozicionEscort()."</td></tr>
                  <tr><td>".$error['state']."</td></tr>
               <tr> <td><b>".$text['f_state'][$_SESSION['lang']]."</b></td> <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['team']."</td></tr>
               <tr> <td><b><font color=red>".$text['f_team'][$_SESSION['lang']]."</font></b></td> <td> "; echo fillDropdownTeam()."</td></tr>
            </table><br>
               <input type='hidden' name='check' value='true'>
               <input type='hidden' name='id_escort' value=\"".$id."\"'>
               <input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
         </fieldset>
         </form>
         ";
   }


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $defaultUser
    * @global <type> $czechWord
    */
   function checkForm() {

      global $error;
      global $text;
      global $defaultUser;
      global $czechWord;

      if( $_POST["check"]=='false' )
      {
         editEscort();
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

      // tisk formulare
         if( !$error["name"]=="" || !$error["surname"]=="" || !$error["date"]=="" || !$error["hometown"]==""
            || !$error["street"]=="" || !$error["city"]=="" || !$error["zip"]=="" || !$error["state"]==""
            || !$error["team"]=="" || !$error["family"]==""	|| !$error["pozicion"]==""	)
         {
            writeFormEscort($_POST["id_escort"], $_POST["name"], $_POST["surname"], $_POST["date"],  $_POST["hometown"],
                      $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]); //odebran $_POST["team"]
         }
         else
         {
            $error["escort"] = "";
            $quastion = "UPDATE `DOPROVODNY_TYM` SET `JMENO`='".$_POST["name"]."', `PRIJMENI`='".$_POST["surname"]."', `POZICE`='".$_POST["pozicion"]."', `DATUM_NAROZENI`='".$_POST["date"]."',
                     `RODISTE`='".$_POST["hometown"]."', `ULICE`='".$_POST["street"]."', `MESTO`='".$_POST["city"]."', `ZIP`='".$_POST["zip"]."', `STAT`='".strtoupper($_POST["state"])."', `RODINNY_STAV`='".$_POST["family"]."', `TYM`='".StrToUpper($_POST["team"])."'
                     WHERE `ID_DOPROVODNY_TYM`='".$_POST["id_escort"]."';";

            $query = mysql_query($quastion);
            if( !$query )
            {
               echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." DOPROVODNY_TYM.</h2>";
            }
            else
            {
               echo "<h2>DOPROVODNY_TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
            }
         }

      }
   }


   /**
    *
    * @global <type> $file
    */
   function editEscort() {
      global $file;
      $edit_escort[]=array();

      $edit_escort["name"]=$_POST["name"];
      $edit_escort["surname"]=$_POST["surname"];
      $edit_escort["team"]=$_POST["team"];
      $query=mysql_query("SELECT * FROM `DOPROVODNY_TYM` WHERE JMENO='".$edit_escort["name"]."' and PRIJMENI='".$edit_escort["surname"]."' and TYM='".$edit_escort["team"]."';");

      if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
      {
         echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
      }
      else
      {
         $row = mysql_fetch_array($query);

         $edit_escort["id"] = $row["ID_DOPROVODNY_TYM"];
         $edit_escort["name"]=$row["JMENO"];
         $edit_escort["surname"]=$row["PRIJMENI"];
         $edit_escort["date"]=$row["DATUM_NAROZENI"];
         $edit_escort["hometown"]=$row["RODISTE"];
         $edit_escort["street"]=$row["ULICE"];
         $edit_escort["city"]=$row["MESTO"];
         $edit_escort["zip"]=$row["ZIP"];
         $edit_escort["state"]=$row["STAT"];
         $edit_escort["family"]=$row["RODINNY_STAV"];
         $edit_escort["pozicion"]=$row["POZICE"];
         $edit_escort["team"] =$row["TYM"];
      }
      writeFormEscort($edit_escort["id"], $edit_escort["name"],$edit_escort["surname"],$edit_escort["date"],
                     $edit_escort["hometown"],$edit_escort["street"],$edit_escort["city"],$edit_escort["zip"], $edit_escort["state"]);
   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   $file = $files['rule'];
   require_once ("$file");

?>
