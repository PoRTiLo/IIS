<?php

session_name('RT_context');
session_start;

if( !isset($_SESSION['lang']) )
{
	$_SESSION['lang'] = $defaultLanguage;	// nastaveni defaultniho kazyka, cestina
}

$SRDB = defaultConnectSRBD();	// porhlizeni webu bez prihlaseni

?>
