<?php

   DEFINE('DB_USER','xsendl00');
   DEFINE('DB_PASS','n4jertur');
   DEFINE('DB_SOURCE','localhost:/var/run/mysql/mysql.sock');
   DEFINE('DB_DATABASE','RT');

   $SRDB = mysql_connect(DB_SOURCE, DB_USER, DB_PASS);
   if (!$SRDB) die('Nelze se pripojit k databazi MySQL'.mysql_error());
   if (!mysql_select_db(DB_USER, $SRDB)) die('Database neni dostupna '.mysql_error());

?>
