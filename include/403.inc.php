<?php
defined('IN_XHXXFB') or exit('Access Denied');
if($DT_BOT) dhttp(403, $DT_BOT);
$head_title = lang('message->without_permission');
exit(include template('noright', 'message'));
?>