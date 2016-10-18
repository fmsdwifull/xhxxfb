<?php defined('IN_XHXXFB') or exit('Access Denied');?><?php include template('header', 'member');?>
<script type="text/javascript">c(1);</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<?php if($action=='answer') { ?>
<td class="tab_on" id="add"><a href="?mid=<?php echo $mid;?>&action=<?php echo $action;?>&itemid=<?php echo $itemid;?>"><span>我来回答</span></a></td>
<?php } else { ?>
<td class="tab" id="add"><a href="?mid=<?php echo $mid;?>&action=add"><span>我要提问</span></a></td>
<?php if($_userid) { ?>
<td class="tab" id="s3"><a href="?mid=<?php echo $mid;?>"><span>已发布<span class="px10">(<?php echo $nums['3'];?>)</span></span></a></td>
<td class="tab" id="s2"><a href="?mid=<?php echo $mid;?>&status=2"><span>审核中<span class="px10">(<?php echo $nums['2'];?>)</span></span></a></td>
<td class="tab" id="s1"><a href="?mid=<?php echo $mid;?>&status=1"><span>未通过<span class="px10">(<?php echo $nums['1'];?>)</span></span></a></td>
<?php } ?>
<?php } ?>
</tr>
</table>
</div>
<?php if($action=='add') { ?>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<form method="post" action="?" id="dform" target="send" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="post[ask]" value="<?php echo $ask;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> 您的提问</td>
<td class="tr"><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<?php if($action=='add' && $could_color) { ?>
<tr>
<td class="tl">标题颜色</td>
<td class="tr">
<?php echo dstyle('color');?>&nbsp;
设置信息标题颜色需消费 <strong class="f_red"><?php echo $MOD['credit_color'];?></strong> <?php echo $DT['credit_name'];?>
</td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 问题分类</td>
<td class="tr"><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '选择分类', $catid, $moduleid, $DT_TOUCH ? '' : 'size="2" style="height:120px;width:180px;"');?><?php if(!$DT_TOUCH) { ?><br/><?php } ?>
<?php if($DT['schcate_limit']) { ?><input type="button" value="搜索分类" onclick="schcate(<?php echo $moduleid;?>);" class="btn"/> <?php } ?>
<span id="dcatid" class="f_red"></span></td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 0;
</script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/property.js"></script>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php if($FD) { ?><?php echo fields_html('<td class="tl">', '<td class="tr">', $item);?><?php } ?>
<tr>
<td class="tl">补充说明</td>
<td class="tr"><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $group_editor, '100%', 350);?>
<span class="f_gray">详细的问题说明，有助于回答者给出准确的答案</span><br/>
<span id="dcontent" class="f_red"></span>
</td>
</tr>
<?php if($action=='add') { ?>
<tr>
<td class="tl">悬赏<?php echo $DT['credit_name'];?></td>
<td class="tr">
<select name="post[credit]" id="credit">
<?php if(is_array($CREDITS)) { foreach($CREDITS as $v) { ?>
<option value="<?php echo $v;?>"<?php if($v==$credit) { ?> selected<?php } ?>
><?php echo $v;?></option> 
<?php } } ?>
</select>
您目前的<?php echo $DT['credit_name'];?>为<?php echo $_credit;?> <span id="dcredit" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">匿名设定</td>
<td class="tr">
<input type="checkbox" name="post[hidden]" value="1" id="hidden"/>
您可以对问题设定匿名，但您需要付出<?php echo $MOD['credit_hidden'];?><?php echo $DT['credit_name'];?> <span id="dhidden" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($fee_add) { ?>
<tr>
<td class="tl">发布此信息需消费</td>
<td class="tr"><span class="f_b f_red"><?php echo $fee_add;?></span> <?php echo $fee_unit;?></td>
</tr>
<?php if($fee_currency == 'money') { ?>
<tr>
<td class="tl"><?php echo $DT['money_name'];?>余额</td>
<td class="tr"><span class="f_blue f_b"><?php echo $_money;?><?php echo $fee_unit;?></span> <a href="charge.php?action=pay" target="_blank" class="t">[充值]</a></td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>余额</td>
<td class="tr"><span class="f_blue f_b"><?php echo $_credit;?><?php echo $fee_unit;?></span> <a href="credit.php?action=buy" target="_blank" class="t">[购买]</a></td>
</tr>
<?php } ?>
<?php } ?>
<?php if($need_password) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 支付密码</td>
<td class="tr"><?php include template('password', 'chip');?> <span id="dpassword" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_question) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证问题</td>
<td class="tr"><?php include template('question', 'chip');?> <span id="danswer" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_captcha) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证码</td>
<td class="tr"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($action=='add') { ?>
<tr style="display:none;" id="weibo_sync">
<td class="tl">同步主题</td>
<td class="tr" id="weibo_show"></td>
</tr>
<?php } ?>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="submit" value=" 提 交 " class="btn_g"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<?php echo load('clear.js');?>
<?php if($action=='add') { ?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('<?php echo $action;?>');</script>
<?php } else { ?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php } else if($action=='answer') { ?>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<form method="post" action="?" id="dform" target="send" onsubmit="return check();">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td class="tl">问题原文：</td>
<td class="tr"><a href="<?php echo $linkurl;?>" class="t"><?php echo $item['title'];?></a></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 答案内容：</td>
<td class="tr"><textarea name="content" id="content" class="dsn"></textarea>
<?php echo deditor($moduleid, 'content', 'Basic', '100%', 200);?>
<br/><span id="dcontent" class="f_red px12"></span>
</td>
</tr>
<tr>
<td class="tl">参考资料：</td>
<td class="tr"><input type="text" name="url" size="60" id="url"/></td>
</tr>
<?php if($_userid) { ?>
<tr>
<td class="tl">匿名设定：</td>
<td class="tr"><input type="checkbox" name="hidden" value="1" id="hidden"/> 如果不需要显示您的信息，您可以对回答设定匿名</td>
</tr>
<?php } ?>
<?php if($need_question) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证问题：</td>
<td class="tr"><?php include template('question', 'chip');?> <span id="danswer" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_captcha) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证码：</td>
<td class="tr"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<?php } ?>
<tr>
<td class="tl"></td>
<td class="tr"><input type="submit" name="submit" value=" 提交回答 " class="btn_g"/></td>
</tr>
<?php if(!$_userid) { ?>
<tr>
<td class="tl"></td>
<td class="tr">
登录后回答可以获得<?php echo $DT['credit_name'];?>奖励，并可以查看和管理所有的回答。<a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>" target="_top" class="b">登录</a> | <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>" target="_top" class="b">注册</a><br/>
</td>
</tr>
<?php } ?>
</table>
</form>
<?php echo load('clear.js');?>
<script type="text/javascript">
function check() {
var l;
var f;
f = 'content';
l = FCKLen();
if(l < 5) {
Dmsg('内容应最少5字，当前已输入'+l+'字', f);
return false;
}
<?php if($need_captcha) { ?>
f = 'captcha';
l = Dd(f).value;
if(!is_captcha(l)) {
Dmsg('请填写正确的验证码', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
<?php if($need_question) { ?>
f = 'answer';
l = Dd(f).value.length;
if(l < 1) {
Dmsg('请填写验证问题', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
}
</script>
<script type="text/javascript">s('mid_<?php echo $mid;?>');</script>
<?php } else { ?>
<div class="tt">
<form action="?">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
&nbsp;<?php echo category_select('catid', '所有分类', $catid, $moduleid);?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<input type="submit" value=" 搜 索 " class="btn"/>
<input type="button" value=" 重 置 " class="btn" onclick="Go('?mid=<?php echo $mid;?>&status=<?php echo $status;?>');"/>
</form>
</div>
<div class="ls">
<table cellpadding="0" cellspacing="0" class="tb">
<tr>
<th width="30">状态</th>
<th>标 题</th>
<th>分 类</th>
<th><?php if($timetype=='add') { ?>添加<?php } else { ?>更新<?php } ?>
时间</th>
<th>悬赏</th>
<th>浏览</th>
<th>回答</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><a href="<?php echo $v['linkurl'];?>" target="_blank"><img src="<?php echo DT_SKIN;?>image/know_<?php echo $v['process'];?>.gif" alt="<?php echo $PROCESS[$v['process']];?>"/></a></td>
<td align="left" title="<?php echo $v['alt'];?>">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank" class="t"><?php echo $v['title'];?></a><?php if($v['status']==1 && $v['note']) { ?> <a href="javascript:" onclick="alert('<?php echo $v['note'];?>');"><img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/why.gif" title="未通过原因"/></a><?php } ?>
</td>
<td>&nbsp;&nbsp;<a href="<?php echo $v['caturl'];?>" target="_blank"><?php echo $v['catname'];?></a>&nbsp;&nbsp;</td>
<?php if($timetype=='add') { ?>
<td class="f_gray px11" title="更新时间 <?php echo $v['editdate'];?>"><?php echo $v['adddate'];?></td>
<?php } else { ?>
<td class="f_gray px11" title="添加时间 <?php echo $v['adddate'];?>"><?php echo $v['editdate'];?></td>
<?php } ?>
<td class="f_gray px11"><?php echo $v['credit'];?></td>
<td class="f_gray px11"><?php echo $v['hits'];?></td>
<td class="f_gray px11"><?php echo $v['answer'];?></td>
</tr>
<?php } } ?>
</table>
</div>
<?php if($MG['know_limit'] || (!$MG['fee_mode'] && $MOD['fee_add'])) { ?>
<div class="limit">
<?php if($MG['know_limit']) { ?>
总共可发 <span class="f_b f_red"><?php echo $MG['know_limit'];?></span> 条&nbsp;&nbsp;&nbsp;
当前已发 <span class="f_b"><?php echo $limit_used;?></span> 条&nbsp;&nbsp;&nbsp;
还可以发 <span class="f_b f_blue"><?php echo $limit_free;?></span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
<?php if(!$MG['fee_mode'] && $MOD['fee_add']) { ?>
发布信息收费 <span class="f_b f_red"><?php echo $MOD['fee_add'];?></span> <?php if($MOD['fee_currency'] == 'money') { ?><?php echo $DT['money_unit'];?><?php } else { ?><?php echo $DT['credit_unit'];?><?php } ?>
/条&nbsp;&nbsp;&nbsp;
可免费发布 <span class="f_b"><?php if($MG['know_free_limit']<0) { ?>无限<?php } else { ?><?php echo $MG['know_free_limit'];?><?php } ?>
</span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
</div>
<?php } ?>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php if($action == 'add') { ?>
<script type="text/javascript">
function check() {
var l;
var f;
f = 'title';
l = Dd(f).value.length;
if(l < 5 || l > 30) {
Dmsg('提问标题应为5-30字，当前已输入'+l+'字', f);
return false;
}
f = 'catid_1';
if(Dd(f).value == 0) {
Dmsg('请选择问题分类', 'catid', 1);
return false;
}
<?php if($action=='add') { ?>
f = 'credit';
if(Dd(f).value > <?php echo $_credit;?>) {
Dmsg('您的<?php echo $DT['credit_name'];?>不足', f);
return false;
}
f = 'hidden';
if(Dd(f).checked && Dd('credit').value > <?php echo $_credit;?>-<?php echo $MOD['credit_hidden'];?>) {
Dmsg('您的<?php echo $DT['credit_name'];?>不足', f);
return false;
}
<?php } ?>
<?php if($FD) { ?><?php echo fields_js();?><?php } ?>
<?php if($CP) { ?><?php echo property_js();?><?php } ?>
<?php if($need_password) { ?>
f = 'password';
l = Dd(f).value.length;
if(l < 6) {
Dmsg('请填写支付密码', f);
return false;
}
<?php } ?>
<?php if($need_question) { ?>
f = 'answer';
l = Dd(f).value.length;
if(l < 1) {
Dmsg('请填写验证问题', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
<?php if($need_captcha) { ?>
f = 'captcha';
l = Dd(f).value;
if(!is_captcha(l)) {
Dmsg('请填写正确的验证码', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
return true;
}
var xhxxfb_oauth = '<?php echo $EXT['oauth'];?>';
</script>
<?php } ?>
<?php if($action=='add' && strlen($EXT['oauth']) > 1) { ?><?php echo load('weibo.js');?><?php } ?>
<?php include template('footer', 'member');?>