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
   $error['hometown']="";
   $error['street']="";
   $error['city']="";
   $error['zip']="";
   $error['state']="";
   $error['family']="";
   $error['referee']="";


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $files
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
   function writeFormReferee($id,$name, $surname, $date, $hometown, $street, $city, $zip, $state) {
      global $error;
      global $text;
      global $files;
      echo"
      <div class=\"formular\">
         <form action=".$files["editReferee"]." method=post>
            <h2><font color=red>".$error['referee']."</font></h2>
            <h2>".$text['add_referee'][$_SESSION['lang']]."</h2>
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
            <input type='hidden' name='check' value='true'>
            <input type='hidden' name='id_referee' value=\"".$id."\"'>
            <input type=submit value=".$text['send_buttom'][$_SESSION['lang']].">
         </form>
      </div>
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
         editReferee();
      }
      else
      {
         checkNameM();              //kontrola jmena
         checkSurnameM();           //kontrola prijmeni
         checkDateM();              //kontrola datumu narozeni
         checkHometownM();          //kotrolo rodiste
         checkStreet();             //kontrola ulice
         checkCity();               //kontrola mesta
         checkZipM();               //kontrola ZIP
         checkFamilyM();            //kontrola rodinneho stavu
         checkStateM();             //kontrola statu

      // tisk formulare
         if( !$error["name"]=="" || !$error["surname"]=="" || !$error["date"]=="" || !$error["hometown"]==""
           || !$error["street"]=="" || !$error["city"]=="" || !$error["zip"]=="" || !$error["state"]=="" || !$error["state"]=="" || !$error["family"]=="")
         {
            writeFormReferee($_POST["id_referee"], $_POST["name"], $_POST["surname"], $_POST["date"], $_POST["hometown"], $_POST["street"], $_POST["city"], $_POST["zip"], $_POST["state"]);
         }
         else
         {
            $error["referee"] = "";
            $quastion = "UPDATE `ROZHODCI` SET `JMENO`='".$_POST["name"]."', `PRIJMENI`='".$_POST["surname"]."', `DATUM_NAROZENI`='".$_POST["date"]."',
                        `RODISTE`='".$_POST["hometown"]."', `ULICE`='".$_POST["street"]."', `MESTO`='".$_POST["city"]."', `ZIP`='".$_POST["zip"]."', `STAT`='".strtoupper($_POST["state"])."', `RODINNY_STAV`='".$_POST["family"]."'
                        WHERE `ID_ROZHODCI`='".$_POST["id_referee"]."';";
            $query = mysql_query($quastion);
            echo mysql_error();
            if( !$query )
            {
               echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." ROZHODCI.</h2>";
            }
            else
            {
               echo "<h2>ROZHODCI ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
            }
         }

      }
   }


   /**
    *
    * @global <type> $file
    */
   function editReferee() {
      global $file;
      $edit_referee[]=array();

      $edit_referee["name"]=$_POST["name"];
      $edit_referee["surname"]=$_POST["surname"];
      $query=mysql_query("SELECT * FROM `ROZHODCI` WHERE JMENO='".$edit_referee["name"]."' and PRIJMENI='".$edit_referee["surname"]."';");

      if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
      {
         echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
      }
      else
      {
         $row = mysql_fetch_array($query);

         $edit_referee["id"] = $row["ID_ROZHODCI"];
         $edit_referee["name"]=$row["JMENO"];
         $edit_referee["surname"]=$row["PRIJMENI"];
         $edit_referee["date"]=$row["DATUM_NAROZENI"];
         $edit_referee["hometown"]=$row["RODISTE"];
         $edit_referee["street"]=$row["ULICE"];
         $edit_referee["city"]=$row["MESTO"];
         $edit_referee["zip"]=$row["ZIP"];
         $edit_referee["state"]=$row["STAT"];
         $edit_referee["family"]=$row["RODINNY_STAV"];
      }
      writeFormReferee($edit_referee["id"], $edit_referee["name"],$edit_referee["surname"],$edit_referee["date"], $edit_referee["hometown"],$edit_referee["street"],$edit_referee["city"],$edit_referee["zip"], $edit_referee["state"]);
   }

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

   checkForm();

?>