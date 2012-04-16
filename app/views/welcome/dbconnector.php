<?php 

$link = mysql_connect('mysql.ems.psu.edu', 'eed_rubric_user', 'E2conklNadyq2P');
if (!$link) {
  die('Could not connect: ' . mysql_error());
}
mysql_select_db('eed_rubric');

?>