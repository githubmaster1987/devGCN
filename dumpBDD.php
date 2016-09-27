<?php

$dbhost   = "mysql5-8";
$dbuser   = "drbellitybdd";
$dbpwd    = "OMlktMwr";
$dbname   = "drbellitybdd";
$dumpfile = $dbname . "_" . date("Y-m-d_H-i-s") . ".sql";

passthru("/usr/bin/mysqldump --opt --host=$dbhost --user=$dbuser --password=$dbpwd $dbname > $dumpfile");

// report - disable with // if not needed
// must look like "-- Dump completed on ..." 

echo "$dumpfile "; passthru("tail -1 $dumpfile");

?>