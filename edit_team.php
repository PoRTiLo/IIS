<?php

   include 'default.php';
   $file = $files["connect"];
   require_once ("$file");
   $file = $files['common'];
   require_once ("$file");
   session_name('RT_kontext');
   session_start();

   $file = $files['showHead'];
   require_once ("$file");
   $file = $files['head'];
   require_once ("$file");

   $_SESSION['lang'] = 0;
   $error[]=array();
   $error['code']="";
   $error['state']="";
   $error['slogan']="";
   $error['team']="";
   $error['group']="";


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $files
    * @param <type> $code
    * @param <type> $state
    * @param <type> $group
    * @param <type> $slogan 
    */
   function writeFormTeam($code, $state, $group, $slogan) {
      global $error;
      global $text;
      global $files;
      echo"
      <div class=\"formular\">
         <form method=post action=".$files["editTeam"].">
               <h2><font color=red>".$error['team']."</font></h2>
               <h2>".$text['add_team'][$_SESSION['lang']]."</h2>
               <table>
                  <tr> <td>".$error['code']."</td> </tr>
                  <tr> <td><b>".$text['t_code'][$_SESSION['lang']]."</b></td> <td><input type='text' readonly name='code' value=\"".$code."\" size='20' maxlength='40' /></td></tr>
                  <tr> <td>".$error['state']."</td> </tr>
                  <tr> <td><b><font color=red>".$text['t_state'][$_SESSION['lang']]."</font></b> </td> <td><input type='text' name='state' value=\"".$state."\" size='20' maxlength='40' /></td></tr>
                  <tr> <td>".$error['slogan']."</td> </tr>
                  <tr> <td><b>".$text['t_slogan'][$_SESSION['lang']]."</b> </td> <td><input type='textarea' name='slogan' value=\"".$slogan."\" /></td></tr>
                  <tr> <td>".$error['group']."</td> </tr>
                  <tr> <td><b>".$text['t_group'][$_SESSION['lang']]."</b></td> <td><input type='text' readonly name='group' value=\"".$group."\" size='20' maxlength='40' /></td></tr>
              </table><br>
               <input type='hidden' name='check' value='true'>
               <input type=submit value=Odeslat>
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
         editTeam();
      }
      else
      {
         checkNameStateM();            //kontrola nazvu statu
         checkSlogan();                //kontrola sloganu

      // tisk formulare
         if( !$error["state"]=="" || !$error["slogan"]=="" )
         {
            writeFormTeam($_POST["code"], $_POST["state"], $_POST["group"], $_POST["slogan"]);
         }
         else
         {
            $quastion = "UPDATE `TYM` SET `ZEME`='".$_POST["state"]."', `SLOGAN`='".$_POST["slogan"]."' WHERE `KOD_ZEME`='".$_POST["code"]."';";

            $query = mysql_query($quastion);
            if( !$query )
            {
               echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." TYM.</h2>";
            }
            else
            {
               echo "<h2>TYM ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
            }
         }
      }
   }


   /**
    *
    */
   function editTeam() {

      $edit_team[]=array();

      $edit_team["code"]=strtoupper($_POST["code"]);
      $query=mysql_query("SELECT * FROM `TYM` WHERE KOD_ZEME='".$edit_team["code"]."';");

      if( mysql_num_rows($query) == 0 )	// hrac je jiz v databazi
      {
         echo "<h2>".$text['table_full'][ $_SESSION['lang']]."</h2>";
      }
      else
      {
         $row = mysql_fetch_array($query);

         $edit_team["state"]=$row["ZEME"];
         $edit_team["group"]=$row["SKUPINA"];
         $edit_team["slogan"]=$row["SLOGAN"];
      }
      writeFormTeam($edit_team["code"], $edit_team["state"],$edit_team["group"],$edit_team["slogan"]);
   }

   $file = $files['rule'];
   require_once ("$file");

?>