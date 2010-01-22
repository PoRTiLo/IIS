<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-Type: text/html; charset=iso-8859-2");
include 'default.php';

session_name('RT_kontext');
session_start();
require_once('common.inc');	// nahraji soubor



if(isset($_SESSION['result']) && $_SESSION['result']=="admin" )
{
			


			if($_SESSION["access_time"] < strtotime(A_LOG_TIME))
			{   session_destroy();
      		$_SESSION["access_time"] = time()-strtotime("-600 days");

      		require_once('automatic_loggout.php');
      		exit();
			}
			else
			{
session_destroy();
				$_SESSION["access_time"] = time()-strtotime("-600 days");
				require_once('wrong_right.php');
			}
}
else
{	
		header( 'Location: ISCoreAdmin.php'); 		
}







?>
