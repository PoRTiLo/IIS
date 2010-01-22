<?php
   /*
    * Pridani noveho zapasu.
    * Zkontrolovani vstupnich dat jen na zaklade reg vyrazu, zatim bez databaze
    *
    * @todo: kontola datumu
    *			kontrola reg vyrazu u PEOPLE
    */

   include 'default.php';
   $file = $files['common'];
   require_once ("$file");
   session_name('RT_kontext');
   session_start();

   $_SESSION['lang'] = 0;
   $error[]=array();
   $error['date']="";
   $error['place']="";
   $error['score']="";
   $error['over_time']="";
   $error['people']="";
   $error['type']="";
   $error['match']="";
   $error['home']="";
   $error['guest']="";
   $error['referee']="";
   $error['referee2']="";
   $error['referee3']="";
   $error['referee4']="";
   $error['list']="";
   $error['list2']="";
   $error['referee_1']= "";
   $error['referee_2']= "";
   $error['referee_3']= "";
   $error['referee_4']= "";
   $error['home_1']= "";
   $error['guest_1']= "";
   $error['list_1']= "";


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $languageCz
    * @param <type> $date
    * @param <type> $place
    * @param <type> $score
    * @param <type> $over_time
    * @param <type> $people
    */
   function writeForm($date, $place, $score, $over_time, $people) {
      global $files;
      global $error;
      global $text;
      global $languageCz;
      echo "
      <div class=\"formular\">
         <form action=".$files["addMatch"]." method=post>
            <h2><font color=red>".$error['match']."</font></h2>
            <h2>".$text['add_match'][$_SESSION['lang']]."</h2>
            <table>
               <tr><td>".$error['date']."</td> </tr>
              <tr> <td><b><font color=red>".$text['t_date'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='date' value=\"".$date."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['place']." </td></tr>
              <tr> <td><b><font color=red>".$text['t_place'][$_SESSION['lang']]."</font></b></td> <td><input type='text' name='place' value=\"".$place."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['type']." </td></tr>
              <tr> <td><b><font color=red>".$text['t_type'][$_SESSION['lang']]."</font></b></td> <td>"; echo callDropdownPozicionType().fillDropdownGroup()."</td></tr>
               <tr><td>".$error['home']." </td></tr>
               <tr><td>".$error['home_1']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_home_club'][$_SESSION['lang']]."</font></b></td> <td>";
               echo fillDropdownTeam()."</td></tr>
               <tr><td>".$error['guest']." </td></tr>
               <tr><td>".$error['guest_1']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_guest_club'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownTeam2()."</td></tr>
              <tr><td>".$error['referee2']." </td></tr>
              <tr><td>".$error['referee_2']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_referee2'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee2()."</td></tr>
              <tr><td>".$error['referee3']." </td></tr>
              <tr><td>".$error['referee_3']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_referee3'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee3()."</td></tr>
              <tr><td>".$error['referee4']." </td></tr>
              <tr><td>".$error['referee_4']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_referee4'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee4()."</td></tr>
               <tr><td>".$error['referee']." </td></tr>
               <tr><td>".$error['referee_1']." </td></tr>
              <tr> <td><b><font color=red>".$text['f_referee'][$_SESSION['lang']]."</font></b></td> <td>";echo fillDropdownReferee()."</td></tr>
              <tr><td>".$error['score']." </td></tr>
              <tr> <td><b>".$text['t_score'][$_SESSION['lang']]."</b></td> <td><input type='text' name='score' value=\"".$score."\" size='20' maxlength='40' /></td></tr>
               <tr><td>".$error['over_time']." </td></tr>
              <tr> <td><b>".$text['t_over_time'][$_SESSION['lang']]."</b></td> <td><input type='text' name='over_time' value=\"".$over_time."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['people']."</td></tr>
              <tr> <td><b>".$text['t_people'][$_SESSION['lang']]."</b></td> <td><input type='text' name='people' value=\"".$people."\" size='20' maxlength='40' /></td></tr>
              <tr><td>".$error['list_1']."</td></tr>
              <tr> <td><b>".$text['t_list'][$_SESSION['lang']]."</b></td> <td>";echo fillDropdownList()."</td></tr>
              <tr><td>".$error['list_1']."</td></tr>
              <tr> <td><b>".$text['t_list2'][$_SESSION['lang']]."</b></td> <td>";echo fillDropdownList2()."</td></tr>
            </table>
               <input type=submit value=Odeslat>
         </form>
         </div>
         ";
   }


   /**
    *
    * @global <type> $error
    * @global <type> $text
    * @global <type> $repeat
    * @global <type> $defaultUser
    * @global <type> $czechWord
    */
   function checkForm() {

      global $error;
      global $text;
      global $repeat;
      global $defaultUser;
      global $czechWord;

      if( empty($_POST) )
      {
          writeForm("","","","","");
      }
      else
      {
         checkMatchDateM();         //kontrola datumu zapasu
         checkMatchPlaceM();        //kontrola mista zapasu
         checkMatchScoreM();        //kontrola skore
         checkMatchOvertimeM();     //kontrola nastaveni
         checkMatchPeopleM();       //kontrola poctu lidi
         checkMatchTypeM();         //kontrola typu zapasu
         checkMatchHomeM();         //kontrola domaci
         checkMatchGuestM();        //kontrola hostu
         checkMatchRefereeM();      //kontrola hlavniho rozhodciho
         checkMatchReferee2M();     //kontrola pomezniho rozhodciho
         checkMatchReferee3M();     //kontrola pomezniho rozhodciho
         checkMatchReferee4M();     //kontrola pomecneho rozhodciho

      // tisk formulare
         if( !$error["date"]=="" || !$error["place"]=="" || !$error["type"]=="" || !$error["score"]==""
            || !$error["over_time"]=="" || !$error["people"]=="" || !$error["home"]=="" || !$error["guest"]==""
            || !$error["referee"]==""  || !$error["referee2"]==""  || !$error["referee4"]==""  || !$error["referee3"]==""
            || !$error["referee_1"]==""  || !$error["list_1"]=="" || !$error["home_1"]=="" )
         {
            writeForm($_POST["date"], $_POST["place"], $_POST["score"], $_POST["over_time"], $_POST["people"]);
         }
         else
         {
            $query=mysql_query("SELECT * FROM `ZAPAS` WHERE DATUM='".$_POST["date"]."' and
                                                           MISTO='".$_POST["place"]."';");

            if( mysql_num_rows($query) != 0 )	// zapas je jiz v databazi
            {
              $error["match"] = $text['no_match'][ $_SESSION['lang']];
              $_POST["place"] = "";
              checkForm();
            }
            else	// zapas neni v databazi
            {
               $error["match"] = "";
               $query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee"]."';");
               $row = mysql_fetch_array($query);
               $_POST["referee"] = $row["ID_ROZHODCI"];
               $query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee2"]."';");
               $row = mysql_fetch_array($query);
               $_POST["referee2"] = $row["ID_ROZHODCI"];
               $query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee3"]."';");
               $row = mysql_fetch_array($query);
               $_POST["referee3"]= $row["ID_ROZHODCI"];
               $query = mysql_query("SELECT ID_ROZHODCI FROM `ROZHODCI` WHERE `PRIJMENI`='".$_POST["referee4"]."';");
               $row = mysql_fetch_array($query);
               $_POST["referee4"]= $row["ID_ROZHODCI"];

               if( $_POST["type"]!="skupina" )
               {
                  $_POST["group"] = "-";
               }
               $query = mysql_query("INSERT INTO `ZAPAS`
                           (DATUM, MISTO, DOMACI, HOSTE, VYSLEDEK, NASTAVENY_CAS, POCET_DIVAKU, TYP_ZAPASU, ROZ_HLAVNI, ROZ_POMEZ1, ROZ_POMEZ2, ROZ_POMOCNY, SOUPISKA1, SOUPISKA2, SKUPINA) VALUES
                           ('".$_POST["date"]."', '".$_POST["place"]."', '".$_POST["team"]."', '".$_POST["team2"]."', '".$_POST["score"]."', '".$_POST["over_time"]."', '".$_POST["people"]."', '".$_POST["type"]."', '".$_POST["referee"]."', '".$_POST["referee2"]."', '".$_POST["referee3"]."', '".$_POST["referee4"]."', '".$_POST["list"]."', '".$_POST["list2"]."', '".$_POST["group"]."');"
                        );
               if( !$query )
               {
                  echo "<h2>".$text['not_insert_table'][ $_SESSION['lang']]." ZAPAS.</h2>";
               }
               else
               {
                  echo "<h2>ZAPAS ".$text['insert_table'][ $_SESSION['lang']]."</h2>";
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
