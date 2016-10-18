<?php defined('IN_XHXXFB') or exit('Access Denied');?><?php include template('header', $module);?>
<script type="text/javascript">c(1);</script>
<?php if($MYMODS) { ?>
<?php if($_userid) { ?>
<?php } else { ?>
<div class="warn">您还没有登录，目前仅拥有以下栏目的发布权限，建议您 <a href="<?php echo $DT['file_login'];?>" class="t">立即登录</a> 或 <a href="<?php echo $DT['file_register'];?>" class="t">注册会员</a></div>
<?php } ?>
<table cellspacing="1" cellpadding="10" class="tb">
<?php if(is_array($MYMODS)) { foreach($MYMODS as $v) { ?>
<?php if($v == 9) { ?>
<tr>
<td class="tl"><a href="<?php echo $MODULE[$v]['linkurl'];?>" target="_blank">招聘</a></td>
<td class="tr">
<?php if($_userid) { ?><a href="?mid=<?php echo $v;?>" class="b">管理</a>&nbsp;&nbsp;<?php } ?>
<a href="?mid=<?php echo $v;?>&action=add" class="b">发布</a>
</td>
</tr>
<?php } else if($v==-9) { ?>
<tr>
<td class="tl"><a href="<?php echo $MODULE['9']['linkurl'];?>" target="_blank">简历</a></td>
<td class="tr">
<?php if($_userid) { ?><a href="?mid=9&resume=1" class="b">管理</a>&nbsp;&nbsp;<?php } ?>
<a href="?mid=9&action=add&resume=1" class="b">发布</a>
</td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><a href="<?php echo $MODULE[$v]['linkurl'];?>" target="_blank"><?php echo $MODULE[$v]['name'];?></a></td>
<td class="tr">
<?php if($_userid) { ?><a href="?mid=<?php echo $v;?>" class="b">管理</a>&nbsp;&nbsp;<?php } ?>
<a href="?mid=<?php echo $v;?>&action=add" class="b">发布</a>
</td>
</tr>
<?php } ?>
<?php } } ?>
</table>
<?php } else { ?>
<?php if($_userid) { ?>
<div class="warn">尊敬的<strong><?php echo $MG['groupname'];?></strong>，您的会员组没有在本站发布信息的权限，请返回。&nbsp;&nbsp;<a href="./" class="t">点击返回个人中心首页</a></div>
<?php } else { ?>
<div class="warn">您还没有登录，目前没有信息发布权限，建议您 <a href="<?php echo $DT['file_login'];?>" class="t">立即登录</a> 或 <a href="<?php echo $DT['file_register'];?>" class="t">注册会员</a></div>
<?php } ?>
<?php } ?>
<?php include template('footer', $module);?>