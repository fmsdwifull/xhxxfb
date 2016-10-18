<?php
defined('IN_XHXXFB') or exit('Access Denied');
$time = $today_endtime - 90*86400;
$db->query("DELETE FROM {$DT_PRE}finance_sms WHERE addtime<$time");
?>