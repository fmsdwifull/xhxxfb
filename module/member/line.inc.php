<?php 
defined('IN_XHXXFB') or exit('Access Denied');
login();
$forward or $forward = DT_PATH;
$online = $_online ? 0 : 1;
$db->query("UPDATE {$DT_PRE}member SET online=$online WHERE userid=$_userid");
$db->query("UPDATE {$DT_PRE}online SET online=$online WHERE userid=$_userid");
dheader($forward);
?>