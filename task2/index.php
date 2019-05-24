<?php
ini_set('max_execution_time', 1200);

include 'config.inc.php';
include 'libs/Db.php';

$myDb = new Db(MY_DRIVER);
//$pgDb = new Db(PG_DRIVER);


for ($i=1; $i < 900; $i++) {
    $myDb->generateInsert();
    //$pgDb->generateInsert();
    echo $i,' - ok<br/>';
}