<?php
/*
    * Seznam pouzitych konstant
    *
    * @todo: u ceskych znaku zrusit i cislice, jsou tam zahrnuty :(
    */

   ///////////////////////////
   // Jazyky
   $languageCz	= 0;						// cesky jazyk
   $languageEng = 1;						// anglicky jazyk
   $languageSk = 1;						// slovensky jazyk
   $defaultLanguage = $languageCz;	// defaultni jazyk je cestina

   // ...

   $czechWord = "[A-Z��������ة���ݮa-z���������������]"; // obsahuje jen normlani pismena

   $regNoCzech = "^[^��������ة���ݮ���������������]+$";	// obsahuje vse krome ceskych znaku

   $defaultUser = "user";

?>
