<?php
/*
	[xhxxfb B2B System] Copyright (c) 2008-2015 www.xhxxfb.com
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_XHXXFB') or exit('Access Denied');
if($DT_BOT) return;
if($page == 1) {
	if($DT['cache_hits']) {
		 cache_hits($moduleid, $itemid);
	} else {
		$update .= ',hits=hits+1';
	}
}
if($update) $db->query("UPDATE LOW_PRIORITY {$table} SET ".substr($update, 1)." WHERE itemid=$itemid", 'UNBUFFERED');	
?>