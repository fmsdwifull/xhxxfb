<?php defined('IN_XHXXFB') or exit('Access Denied');?><?php global $PROCESS;?>
<?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
<div class="know_list">
<table>
<tr>
<td width="30"><a href="<?php echo $MODULE[$moduleid]['linkurl'];?><?php echo rewrite('search.php?username='.$t['username']);?>" rel="nofollow"><img src="<?php echo useravatar($t['username'], 'small');?>" width="20" height="20" title="<?php echo $t['passport'];?>" alt=""/></a></td>
<td align="left"><ul><li><?php if($t['credit']) { ?><span class="know_credit"><?php echo $t['credit'];?></span> <?php } ?>
<a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>" class="konw_a"><?php echo $t['title'];?></a></li></ul></td>
<td width="50" align="right"><?php echo $t['answer'];?>回答</td>
<td width="50" align="center"><img src="<?php echo DT_SKIN;?>image/know_<?php echo $t['process'];?>.gif" title="<?php echo $PROCESS[$t['process']];?>"/></td>
<td width="120" class="px11" align="center"><?php echo timetodate($t['edittime'], $datetype);?></td>
</tr>
</table>
</div>
<?php } } ?>
<?php if($showpage && $pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>
