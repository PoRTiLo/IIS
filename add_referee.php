<?php

   include 'default.php';
   $file = $files['common'];
   require_once ("$file");
   session_name('RT_kontext');
   session_start();

   $_SESSION['lang'] = 0;
   $error[]=array();
   $error['name']="";
   $error['surname']="";
   $error['date']="";
   $error['hometown']="";
   $error['street']="";
   $error['city']="";
   $error['zip']="";
   $error['state']="";
   $error['family']="";
   $error['referee']="";

   /**
    *	Vypise formular
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $files
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
      global $files;
      echo"
      <div class=\"formular\">
         <form action=".$files["addReferee"]." method=post>
            <h4><font color=red>".$error['referee']."</font></h4>
            <h4>".$text['add_referee'][$_SESSION['lang']]."</h4>
            <table>
               <tr><td>".$error['name']."</td> </tr>
               <tr> <td><b><font color=red>".$text['f_name'][$_SESSION['lang']]."</font></b></td>
               <td><input type='text' name='name' value=\"".$name."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['surname']."</td> </tr>
               <tr> <td><b><font color=red>".$text['f_surname'][$_SESSION['lang']]."</font></b></td>
               <td><input type='text' name='surname' value=\"".$surname."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['date']."</td> </tr>
               <tr> <td><b><font color=red>".$text['f_date'][$_SESSION['lang']]."</font></b></td>
               <td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['hometown']."</td> </tr>
               <tr> <td><b><font color=red>".$text['f_hometown'][$_SESSION['lang']]."</font></b></td>
               <td><input type='text' name='hometown' value=\"".$hometown."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['street']."</td> </tr>
               <tr> <td><b>".$text['f_street'][$_SESSION['lang']]."</b></td>
               <td><input type='text' name='street' value=\"".$street."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['city']."</td> </tr>
               <tr> <td><b>".$text['f_city'][$_SESSION['lang']]."</b></td>
               <td><input type='text' name='city' value=\"".$city."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['zip']."</td> </tr>
               <tr> <td><b>".$text['f_zip'][$_SESSION['lang']]."</b></td>
               <td><input type='text' name='zip' value=\"".$zip."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['state']."</td> </tr>
               <tr> <td><b>".$text['f_state'][$_SESSION['lang']]."</b></td>
               <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['family']."</td></tr>
               <tr> <td><b><font color=red>".$text['f_family'][$_SESSION['lang']]."</font>
               <td> ";echo callDropdownFamily()."</td></tr>
            </table><br>
            <input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
         </form>
      </div>
      ";
   }
   

   /**
    *	Zkontrolu vlozena data
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
         checkNameM();           // kontrola jmena
         checkSurnameM();        // kontrola prijmeni
         checkDateM();           // kontrola datumu narozeni
         checkHometownM();       // kotrolo rodiste
         checkStreet();          // kontrola ulice
         checkCity();            // kontrola mesta
         checkZipM();            // kontrola ZIP
         checkFamilyM();         // kontrola rodinneho stavu
         checkState();           // kontrola statu

      // tisk formulare
         if( !$error["name"]=="" || !$error["surname"]=="" || !$error["date"]=="" || !$error["hometown"]==""
           || !$error["street"]=="" || !$error["city"]=="" || !$error["zip"]=="" || !$error["state"]=="" || !$error["state"]=="")
         {
            writeForm($_POST["name"], $_POST["surname"], $_POST["date"], $_POST["hometown"], $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]);
         }
         else
         {
            require_once('connect.inc');	// vlozi a ohodnoti inicializacni soubor

            $query=mysql_query("SELECT * FROM `ROZHODCI` WHERE jmeno='".$_POST["name"]."' and
                                                           prijmeni='".$_POST["surname"]."';");

            if( mysql_num_rows($query) != 0 )	// hrac je jiz v databazi
            {
              $error["referee"] = $text['no_referee'][ $_SESSION['lang']];
              $_POST["name"] = "";
              $_POST["surname"] = "";
              checkForm();
            }
            else	// hrac neni v databazi
            {
               $error["referee"] = "";
               $query = mysql_query("INSERT INTO `ROZHODCI`
                           (JMENO, PRIJMENI, DATUM_NAROZENI, RODISTE, ULICE, MESTO, ZIP, STAT, RODINNY_STAV) VALUES
                           ('".$_POST["name"]."', '".$_POST["surname"]."', '".$_POST["date"]."', '".$_POST["hometown"]."', '".$_POST["street"]."', '".$_POST["city"]."', '".$_POST["zip"]."', '".$_POST["state"]."', '".$_POST["family"]."');"
                        );
               if( !$query )
               {
                  echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." HRAC.</h2>";
               }
               else
               {
                  echo "<h2>ROZHODCI ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
                  echo"vypsat to co se tam dalo";
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
