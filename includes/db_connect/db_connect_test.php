<?php
# $ php -f db-connect-test.php

$dbname = 'ntzjh_chatbotdes';
$dbuser = 'ntzjh_chatbt_app';
$dbpass = 'X0ITYYUBJhJj!3pm1oXX';
$dbhost = 'uildbv5gen01.nottingham.ac.uk';

$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");

$test_query = "SHOW TABLES FROM $dbname";
$result = mysqli_query($link, $test_query);

$tblCnt = 0;
while($tbl = mysqli_fetch_array($result)) {
  $tblCnt++;
  #echo $tbl[0]."<br />\n";
}

if (!$tblCnt) {
  echo "There are no tables.\n";
} else {
  echo "There are $tblCnt tables.\n";
}
?>
