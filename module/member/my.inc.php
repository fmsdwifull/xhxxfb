<?php 
defined('IN_XHXXFB') or exit('Access Denied');
require DT_ROOT.'/module/'.$module.'/common.inc.php';
$viewport = 1;
$head_title = $action == 'add' ? $L['info_add'] : $L['info_manage'];
include template('my', $module);
?>