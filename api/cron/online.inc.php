<?php
defined('IN_XHXXFB') or exit('Access Denied');
$lastime = $DT_TIME - $DT['online'];
$db->query("DELETE FROM {$DT_PRE}online WHERE lasttime<$lastime");
?>