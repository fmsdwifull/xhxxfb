<?php
defined('IN_XHXXFB') or exit('Access Denied');
if($CFG['cache'] == 'file') $dc->expire();
?>