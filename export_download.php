<?php

	header("Content-Description: File Transfer");
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=data.xml");

	readfile ("data.xml");
?> 