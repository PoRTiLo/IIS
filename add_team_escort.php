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
    * @param <type> $name
    * @param <type> $surname
    * @param <type> $date
    * @param <type> $hometown
    * @param <type> $street
    * @param <type> $city
    * @param <type> $zip
    * @param <type> $state
    */
   function writeForm($name, $surname, $date, $hometown, $street, $city, $zip, $state) {
      global $error;
      global $text;
      global $languageCz;

      echo "
         <form action=".$files["addTeamEscort"]." method=post>
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

      if( empty($_POST) )
      {
          writeForm("","","","","","","","");
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
            writeForm($_POST["name"], $_POST["surname"], $_POST["date"],  $_POST["hometown"],
                      $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]); //odebran $_POST["team"]
         }
         else
         {
            $query=mysql_query("SELECT * FROM `DOPROVODNY_TYM` WHERE jmeno='".$_POST["name"]."' and
                                                           prijmeni='".$_POST["surname"]."' and
                                                            pozice='".$_POST["pozicion"]."';");

            if( mysql_num_rows($query) != 0 )	// clen doprovodneho tymu je v databazi je jiz v databazi
            {
              $error["escort"] = $text['no_escort'][ $_SESSION['lang']];
              $_POST["name"] = "";
              $_POST["surname"] = "";
              checkForm();
            }
            else	// hrac neni v databazi
            {
               $error["escort"] = "";
               $query = mysql_query("INSERT INTO `DOPROVODNY_TYM`
                           (JMENO, PRIJMENI, DATUM_NAROZENI, RODISTE, ULICE, MESTO, ZIP, STAT, RODINNY_STAV, POZICE, TYM) VALUES
                           ('".$_POST["name"]."', '".$_POST["surname"]."', '".$_POST["date"]."', '".$_POST["hometown"]."', '".$_POST["street"]."', '".$_POST["city"]."', '".$_POST["zip"]."', '".strtoupper($_POST["state"])."', '".$_POST["family"]."', '".$_POST["pozicion"]."', '".strtoupper($_POST["team"])."');"
                        );
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
   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");
   $file = $files['rule'];
   require_once ("$file");

?>
