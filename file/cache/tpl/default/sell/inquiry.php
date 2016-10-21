<?php defined('IN_XHXXFB') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="nav">当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a><?php if($total==1) { ?> &raquo; <a href="<?php echo $MOD['linkurl'];?><?php echo $list['0']['linkurl'];?>"><?php echo $list['0']['title'];?></a><?php } ?>
 &raquo; 询价单</div>
<form method="post" action="<?php echo $MOD['linkurl'];?>inquiry.php" id="dform" onsubmit="return check();">
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<input type="hidden" name="itemids" value="<?php echo $itemids;?>"/>
<table width="100%" cellpadding="8" cellspacing="1" bgcolor="#DDDDDD">
<?php if($total>1) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right">产品服务</td>
<td bgcolor="#FFFFFF">
<?php if(is_array($list)) { foreach($list as $i => $v) { ?>
<div>&raquo; <a href="<?php echo $MOD['linkurl'];?><?php echo $v['linkurl'];?>" target="_blank" class="px14 b"><?php echo $v['title'];?></a> <a href="<?php echo userurl($v['username']);?>" target="_blank">(<?php echo $v['company'];?>)</a><?php if($v['vip']) { ?> <img src="<?php echo DT_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif" alt="<?php echo VIP;?>" title="<?php echo VIP;?>:<?php echo $v['vip'];?>级"/><?php } ?>
</div>
<?php if($i) { ?><div class="b10"></div><?php } ?>
<?php } } ?>
</td>
</tr>
<?php } ?>

<tr>
<td bgcolor="#F7F7F7" align="right" width="150"><span class="f_red">*</span> 询价标题</td>
<td bgcolor="#FFFFFF"><input type="text" name="title" value="<?php echo $title;?>" size="60" id="title"/> <img src="<?php echo DT_SKIN;?>image/ico_tips.gif" alt="" title="建议您修改主题，吸引对方注意,得到优先回复!"/> <span class="f_red" id="dtitle"></span></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">我想了解</td>
<td bgcolor="#FFFFFF">

<table cellpadding="2" cellspacing="2">
<?php if(is_array($itype)) { foreach($itype as $k => $v) { ?>
<?php if($k%5==0) { ?><tr><?php } ?>
<td><input type="checkbox" name="type[]" value="<?php echo $v;?>" id="type_<?php echo $k;?>"<?php if($k<5) { ?> checked<?php } ?>
/><label for="type_<?php echo $k;?>"> <?php echo $v;?></label></td>
<?php if($k%5==4) { ?></tr><?php } ?>
<?php } } ?>
</table>
</td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">快捷提问</td>
<td bgcolor="#FFFFFF">
<select onchange="if(this.value)Dd('content').value+=this.value+'\n';">
<option value="">请选择常用问题</option>
<?php if(is_array($iask)) { foreach($iask as $v) { ?>
<option value="<?php echo $v;?>"><?php echo $v;?></option>
<?php } } ?>
</select>
<span class="f_gray">(不用打字 “快捷提问”帮您忙！) </span>
</td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right"><span class="f_red">*</span> 主要内容</td>
<td bgcolor="#FFFFFF"><textarea rows="8" cols="80" name="content" id="content"></textarea><br/>
我希望在 <?php echo dcalendar('date', $date);?> 日前回复 <span class="f_red" id="dcontent"></span>
</td>
</tr>
<?php if($_userid) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right"><strong>联系方式</strong></td>
<td bgcolor="#F7F7F7">&nbsp; </td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">公司</td>
<td bgcolor="#FFFFFF"><?php echo $company;?></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">姓名</td>
<td bgcolor="#FFFFFF"><?php echo $truename;?></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">电话</td>
<td bgcolor="#FFFFFF"><?php echo $telephone;?></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">邮件</td>
<td bgcolor="#FFFFFF"><?php echo $email;?></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">QQ</td>
<td bgcolor="#FFFFFF"><?php echo $qq;?></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">MSN</td>
<td bgcolor="#FFFFFF"><?php echo $msn;?></td>
</tr>
<?php } else { ?>
<tr>
<td bgcolor="#F7F7F7" align="right"><strong>联系方式</strong></td>
<td bgcolor="#F7F7F7">还不是会员？请 <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>" class="f_b" target="_top">注册</a> 或 请留下您的联系方式&nbsp;&nbsp;已经是会员？请 <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>" class="f_b" target="_top">登录</a></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">公司</td>
<td bgcolor="#FFFFFF"><input type="text" name="company" size="30" id="company"/></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right"><span class="f_red">*</span> 姓名</td>
<td bgcolor="#FFFFFF"><input type="text" name="truename" size="30" id="truename"/> <span class="f_red" id="dtruename"></span></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right"><span class="f_red">*</span> 电话</td>
<td bgcolor="#FFFFFF"><input type="text" name="telephone" size="30" id="telephone"/> <span class="f_red" id="dtelephone"></span></td>
</tr>
<tr>
<td bgcolor="#F7F7F7" align="right">邮箱</td>
<td bgcolor="#FFFFFF"><input type="text" name="email" size="30" id="email"/> <span class="f_red" id="demail"></span></td>
</tr>
<?php if($DT['im_qq']) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right">QQ </td>
<td bgcolor="#FFFFFF"><input type="text" size="20" name="qq" id="qq"/></td>
</tr>
<?php } ?>
<?php if($DT['im_ali']) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right">阿里旺旺 </td>
<td bgcolor="#FFFFFF"><input type="text" size="20" name="ali" id="ali"/></td>
</tr>
<?php } ?>
<?php if($DT['im_msn']) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right">MSN </td>
<td bgcolor="#FFFFFF"><input type="text" size="30" name="msn" id="msn"/></td>
</tr>
<?php } ?>
<?php if($DT['im_skype']) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right">Skype </td>
<td bgcolor="#FFFFFF"><input type="text" size="20" name="skype" id="skype"/></td>
</tr>
<?php } ?>
<?php } ?>
<?php if($need_question) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right"><span class="f_red">*</span> 验证问题</td>
<td bgcolor="#FFFFFF"><?php include template('question', 'chip');?> <span id="danswer" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_captcha) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right"><span class="f_red">*</span> 验证码</td>
<td bgcolor="#FFFFFF"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($_userid && $DT['sms']) { ?>
<tr>
<td bgcolor="#F7F7F7" align="right">短信通知</td>
<td bgcolor="#FFFFFF"><input type="checkbox" name="sendsms" value="1"/> 发送短信通知至接收人手机 (<a href="<?php echo $MODULE['2']['linkurl'];?>sms.php" target="_blank">我的可用短信 <strong class="f_blue"><?php echo $_sms;?></strong> 条</a>)</td>
</tr>
<?php } ?>
<tr>
<td bgcolor="#F7F7F7"> </td>
<td bgcolor="#FFFFFF"><input type="submit" name="submit" value=" 发送<?php if($total==1) { ?>询价<?php } else { ?>批量询价<?php } ?>
 "/>
<?php if($MG['inquiry_limit']) { ?>
&nbsp;&nbsp;&nbsp;今日可询价 <span class="f_b f_red"><?php echo $MG['inquiry_limit'];?></span> 次
&nbsp;&nbsp;&nbsp;当前已询价 <span class="f_b"><?php echo $limit_used;?></span> 次
&nbsp;&nbsp;&nbsp;还可以询价 <span class="f_b f_blue"><?php echo $limit_free;?></span> 次
<?php } ?>

</td>
</tr>
</table>
</form>
</div>
<?php if(!$_userid) { ?><script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/guest.js"></script><?php } ?>
<script type="text/javascript">
function check() {
var l;
var f;
f = 'title';
l = Dd(f).value.length;
if(l < 5 || l > 50) {
Dmsg('标题应为5-50字，当前已输入'+l+'字', f);
return false;
}
f = 'content';
l = Dd(f).value.length;
if(l < 10 || l > 2000) {
Dmsg('内容应为10-2000字，当前已输入'+l+'字', f);
return false;
}
<?php if(!$_userid) { ?>
f = 'truename';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('请填写联系人', f);
return false;
}
f = 'telephone';
l = Dd(f).value.length;
if(l < 7) {
Dmsg('请填写联系电话', f);
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
<?php include template('footer');?>