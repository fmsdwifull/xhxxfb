<?php defined('IN_XHXXFB') or exit('Access Denied');?><?php include template('header', 'member');?>
<script type="text/javascript">c(1);</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="tab" id="add"><a href="?mid=<?php echo $mid;?>&resume=1&action=add"><span>创建简历</span></a></td>
<?php if($_userid) { ?>
<td class="tab" id="s3"><a href="?mid=<?php echo $mid;?>&resume=1"><span>已发布<span class="px10">(<?php echo $nums['3'];?>)</span></span></a></td>
<td class="tab" id="s2"><a href="?mid=<?php echo $mid;?>&resume=1&status=2"><span>审核中<span class="px10">(<?php echo $nums['2'];?>)</span></span></a></td>
<td class="tab" id="s1"><a href="?mid=<?php echo $mid;?>&resume=1&status=1"><span>未通过<span class="px10">(<?php echo $nums['1'];?>)</span></span></a></td>
<td class="tab" id="apply"><a href="?mid=<?php echo $mid;?>&resume=1&action=apply"><span>应聘职位<span class="px10">(<?php echo $nums['apply'];?>)</span></span></a></td>
<?php } ?>
</tr>
</table>
</div>
<?php if($action=='add' || $action=='edit') { ?>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<form method="post" action="?" id="dform" target="send" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="resume" value="1"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<?php if($status==1 && $action=='edit' && $note) { ?>
<tr>
<td class="tl">未通过原因</td>
<td class="tr f_blue"><?php echo $note;?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 简历名称</td>
<td class="tr f_gray"><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/> <span id="dtitle" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 行业/职位</td>
<td class="tr"><div id="catesch"></div><?php echo ajax_category_select('post[catid]', '选择分类', $catid, $moduleid, $DT_TOUCH ? '' : 'size="2" style="height:120px;width:180px;"');?> <?php if(!$DT_TOUCH) { ?><br/><?php } ?>
<?php if($DT['schcate_limit']) { ?><input type="button" value="搜索分类" onclick="schcate(<?php echo $moduleid;?>);" class="btn"/> <?php } ?>
<span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 真实姓名</td>
<td class="tr"><input name="post[truename]" type="text" id="truename" size="20" value="<?php echo $truename;?>" /> <br/><span id="dtruename" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">免冠照片</td>
<td class="tr"><input name="post[thumb]" type="text" size="60" id="thumb" value="<?php echo $thumb;?>" readonly/>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="t">[上传]</a>&nbsp;&nbsp;<a href="javascript:_preview(Dd('thumb').value);" class="t">[预览]</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="Dd('thumb').value='';" class="t">[删除]</a></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 性别</td>
<td class="tr">
<?php if(is_array($GENDER)) { foreach($GENDER as $k => $v) { ?>
<?php if($k > 0) { ?>
<input type="radio" name="post[gender]" id="gender_<?php echo $k;?>" value="<?php echo $k;?>"<?php if($k == $gender) { ?> checked<?php } ?>
/><label for="gender_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php } ?>
<?php } } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 婚姻状况</td>
<td class="tr">
<?php if(is_array($MARRIAGE)) { foreach($MARRIAGE as $k => $v) { ?>
<?php if($k > 0) { ?>
<input type="radio" name="post[marriage]" id="marriage_<?php echo $k;?>" value="<?php echo $k;?>"<?php if($k == $marriage) { ?> checked<?php } ?>
/><label for="marriage_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php } ?>
<?php } } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 现居住地</td>
<td class="tr"><?php echo ajax_area_select('post[areaid]', '请选择', $areaid);?> <span id="dareaid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 生日</td>
<td class="tr">
<input name="post[byear]" type="text" id="byear" size="4" value="<?php echo $byear;?>"/> 年
<select name="post[bmonth]">
<?php for($i = 1; $i < 13; $i++) { ?>
<option value="<?php echo $i;?>"<?php if($i == $bmonth) { ?> selected<?php } ?>
><?php echo $i;?></option>
<?php } ?>
</select>
月
<select name="post[bday]">
<?php for($i = 1; $i < 32; $i++) { ?>
<option value="<?php echo $i;?>"<?php if($i == $bday) { ?> selected<?php } ?>
><?php echo $i;?></option>
<?php } ?>
</select>
日
<span id="dbyear" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl">身高</td>
<td class="tr"><input name="post[height]" type="text" id="height" size="10" value="<?php echo $height;?>" /> cm <span id="dheight" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">体重</td>
<td class="tr"><input name="post[weight]" type="text" id="weight" size="10" value="<?php echo $weight;?>" /> kg <span id="dweight" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 学历</td>
<td class="tr">
<?php if(is_array($EDUCATION)) { foreach($EDUCATION as $k => $v) { ?>
<?php if($k > 0) { ?>
<input type="radio" name="post[education]" id="education_<?php echo $k;?>" value="<?php echo $k;?>"<?php if($k == $education) { ?> checked<?php } ?>
/><label for="education_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php } ?>
<?php } } ?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 毕业院校</td>
<td class="tr"><input name="post[school]" type="text" id="school" size="30" value="<?php echo $school;?>"/> <span id="dschool" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">所学专业</td>
<td class="tr"><input name="post[major]" type="text" id="major" size="30" value="<?php echo $major;?>"/></td>
</tr>
<tr>
<td class="tl">专业技能</td>
<td class="tr"><input name="post[skill]" type="text" size="50" value="<?php echo $skill;?>"/></td>
</tr>
<tr>
<td class="tl">语言水平</td>
<td class="tr"><input name="post[language]" type="text"  size="50" value="<?php echo $language;?>"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 工作性质</td>
<td class="tr">
<?php if(is_array($TYPE)) { foreach($TYPE as $k => $v) { ?>
<?php if($k > 0) { ?>
<input type="radio" name="post[type]" id="type_<?php echo $k;?>" value="<?php echo $k;?>"<?php if($k == $type) { ?> checked<?php } ?>
/><label for="type_<?php echo $k;?>"> <?php echo $v;?></label> 
<?php } ?>
<?php } } ?>
</td>
</tr>
<tr>
<td class="tl">期望薪资</td>
<td class="tr"><input name="post[minsalary]" type="text" id="minsalary" size="6" value="<?php echo $minsalary;?>"/> 至 <input name="post[maxsalary]" type="text" id="maxsalary" size="6" value="<?php echo $maxsalary;?>"/> <?php echo $DT['money_unit'];?>/月 (不填或者填0为不限)</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 工作经验</td>
<td class="tr">
<input type="text" name="post[experience]" value="<?php echo $experience;?>" size="4" id="experience"/> &nbsp;&nbsp;年 <span id="dexperience" class="f_red"></span></td>
</tr>
<?php if($FD) { ?><?php echo fields_html('<td class="tl">', '<td class="tr">', $item);?><?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 自我鉴定</td>
<td class="tr f_gray"><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $group_editor, '100%', 350);?><br/><span id="dcontent" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 联系手机</td>
<td class="tr"><input name="post[mobile]" id="mobile" type="text" size="30" value="<?php echo $mobile;?>"/> <span id="dmobile" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 电子邮件</td>
<td class="tr"><input name="post[email]" id="email" type="text" size="30" value="<?php echo $email;?>" /> <span id="demail" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">联系电话</td>
<td class="tr"><input name="post[telephone]" id="telephone" type="text" size="30" value="<?php echo $telephone;?>"/> <span id="dtelephone" class="f_red"></span></td>
</tr>
<tr>
<td class="tl">联系地址</td>
<td class="tr"><input name="post[address]" id="address" type="text" size="60" value="<?php echo $address;?>"/></td>
</tr>
<?php if($DT['im_qq']) { ?>
<tr>
<td class="tl">QQ</td>
<td class="tr"><input name="post[qq]" id="qq" type="text" size="30" value="<?php echo $qq;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_ali']) { ?>
<tr>
<td class="tl">阿里旺旺</td>
<td class="tr"><input name="post[ali]" id="ali" type="text" size="30" value="<?php echo $ali;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_msn']) { ?>
<tr>
<td class="tl">MSN</td>
<td class="tr"><input name="post[msn]" id="msn" type="text" size="40" value="<?php echo $msn;?>"/></td>
</tr>
<?php } ?>
<?php if($DT['im_skype']) { ?>
<tr>
<td class="tl">Skype</td>
<td class="tr"><input name="post[skype]" id="skype" type="text" size="30" value="<?php echo $skype;?>"/></td>
</tr>
<?php } ?>
<tr>
<td class="tl">求职状态</td>
<td class="tr">
<select name="post[situation]">
<?php if(is_array($SITUATION)) { foreach($SITUATION as $k => $v) { ?>
<option value="<?php echo $k;?>"<?php if($k==$situation) { ?> selected<?php } ?>
><?php echo $v;?></option> 
<?php } } ?>
</select>
</td>
</tr>
<tr>
<td class="tl">公开程度</td>
<td class="tr">
<input type="radio" name="post[open]" value="3"<?php if($open==3) { ?> checked<?php } ?>
/> 开放
<input type="radio" name="post[open]" value="2"<?php if($open==2) { ?> checked<?php } ?>
/> 仅网站可见
<input type="radio" name="post[open]" value="1"<?php if($open==1) { ?> checked<?php } ?>
/> 关闭
</td>
</tr>
<tr>
<td class="tl">简历模板</td>
<td class="tr"><?php echo tpl_select('resume', $module, 'post[template]', '默认模板', $template, 'id="template"');?></td>
</tr>
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
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="submit" value=" 提 交 " class="btn_g"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<?php echo load('clear.js');?>
<?php echo load('guest.js');?>
<?php if($action=='add') { ?>
<script type="text/javascript">s('mid_resume');m('<?php echo $action;?>');</script>
<?php } else { ?>
<script type="text/javascript">s('mid_resume');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php } else if($action=='apply') { ?>
<div class="tt">
<form action="?">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="resume" value="1"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
&nbsp;<?php echo category_select('catid', '行业/职位', $catid, $moduleid);?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<input type="submit" value=" 搜 索 " class="btn"/>
<input type="button" value=" 重 置 " class="btn" onclick="Go('?mid=<?php echo $mid;?>&resume=1&action=<?php echo $action;?>');"/>
</form>
</div>
<div class="ls">
<table cellpadding="0" cellspacing="0" class="tb">
<tr>
<th>招聘信息</th>
<th>我的简历</th>
<th>应聘时间</th>
<th>状态</th>
<th width="60">管理</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[$mid]['linkurl'];?><?php echo $v['linkurl'];?>" target="_blank" class="t"><?php echo $v['title'];?></a></td>
<td align="left">&nbsp;&nbsp;<a href="<?php echo $MODULE[$mid]['linkurl'];?><?php echo rewrite('resume.php?itemid='.$v['resumeid']);?>" target="_blank" class="t"><?php echo $v['resumetitle'];?></a></td>
<td class="f_gray px11"><?php echo timetodate($v['applytime'], 5);?></td>
<td>&nbsp;&nbsp;
<?php if($v['status'] == 3) { ?>
<span class="f_blue">邀请面试</span>
<?php } else if($v['status'] == 2) { ?>
已查看
<?php } else if($v['status'] == 1) { ?>
<span class="f_gray">未查看</span>
<?php } else if($v['status'] == 0) { ?>
<span class="f_red">已拒绝</span>
<?php } ?>
&nbsp;&nbsp;
</td>
<td>
<a href="?mid=<?php echo $mid;?>&resume=1&action=apply_delete&itemid=<?php echo $v['applyid'];?>" onclick="return confirm('确定要删除吗？此操作将不可撤销');"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/delete.png" title="删除" alt=""/></a>
</td>
</tr>
<?php } } ?>
</table>
</div>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">s('mid_resume');m('apply');</script>
<?php } else { ?>
<div class="tt">
<form action="?">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="resume" value="1"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
&nbsp;<?php echo category_select('catid', '行业/职位', $catid, $moduleid);?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<input type="submit" value=" 搜 索 " class="btn"/>
<input type="button" value=" 重 置 " class="btn" onclick="Go('?mid=<?php echo $mid;?>&resume=1&status=<?php echo $status;?>');"/>
</form>
</div>
<div class="ls">
<table cellpadding="0" cellspacing="0" class="tb">
<tr>
<th>标 题</th>
<th>行 业</th>
<th>职 位</th>
<th>更新时间</th>
<th>状态</th>
<th>浏览</th>
<th width="100">管理</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td align="left">&nbsp;&nbsp;&nbsp;<?php if($v['status']==3) { ?><a href="<?php echo $v['linkurl'];?>" target="_blank" class="t"><?php } else { ?><a href="?mid=<?php echo $mid;?>&resume=1&action=edit&itemid=<?php echo $v['itemid'];?>" class="t"><?php } ?>
<?php echo $v['title'];?></a><?php if($v['status']==1 && $v['note']) { ?> <a href="javascript:" onclick="alert('<?php echo $v['note'];?>');"><img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/why.gif" title="未通过原因"/></a><?php } ?>
</td>
<td>&nbsp;<?php echo $CATEGORY[$v['parentid']]['catname'];?>&nbsp;</td>
<td><?php echo $CATEGORY[$v['catid']]['catname'];?></td>
<td class="f_gray px11" title="添加时间 <?php echo timetodate($v['addtime'], 5);?>"><?php echo timetodate($v['edittime'], 5);?></td>
<td>
<?php if($v['open'] == 3) { ?>
开放
<?php } else if($v['open'] == 2) { ?>
<span class="f_blue">网站可见</span>
<?php } else if($v['open'] == 1) { ?>
<span class="f_red">关闭</span>
<?php } else { ?>
&nbsp;
<?php } ?>
</td>
<td class="f_gray px11"><?php echo $v['hits'];?></td>
<td>
<a href="?mid=<?php echo $mid;?>&resume=1&action=edit&itemid=<?php echo $v['itemid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/edit.png" title="修改" alt=""/></a>&nbsp;
<a href="?mid=<?php echo $mid;?>&resume=1&action=add&itemid=<?php echo $v['itemid'];?>&catid=<?php echo $v['catid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/new.png" title="复制简历" alt=""/></a>&nbsp;
<a href="?mid=<?php echo $mid;?>&resume=1&action=refresh&itemid=<?php echo $v['itemid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/refresh.png" title="一键更新" alt=""/></a>&nbsp;
<a href="?mid=<?php echo $mid;?>&resume=1&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return confirm('确定要删除吗？此操作将不可撤销');"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/delete.png" title="删除" alt=""/></a>
</td>
</tr>
<?php } } ?>
</table>
</div>
<?php if($MG['resume_limit'] || (!$MG['fee_mode'] && $MOD['fee_add'])) { ?>
<div class="limit">
<?php if($MG['resume_limit']) { ?>
总共可发 <span class="f_b f_red"><?php echo $MG['resume_limit'];?></span> 条&nbsp;&nbsp;&nbsp;
当前已发 <span class="f_b"><?php echo $limit_used;?></span> 条&nbsp;&nbsp;&nbsp;
还可以发 <span class="f_b f_blue"><?php echo $limit_free;?></span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
<?php if(!$MG['fee_mode'] && $MOD['fee_add']) { ?>
发布信息收费 <span class="f_b f_red"><?php echo $MOD['fee_add'];?></span> <?php if($MOD['fee_currency'] == 'money') { ?><?php echo $DT['money_unit'];?><?php } else { ?><?php echo $DT['credit_unit'];?><?php } ?>
/条&nbsp;&nbsp;&nbsp;
可免费发布 <span class="f_b"><?php if($MG['resume_free_limit']<0) { ?>无限<?php } else { ?><?php echo $MG['resume_free_limit'];?><?php } ?>
</span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
</div>
<?php } ?>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">s('mid_resume');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php if($action == 'add' || $action == 'edit') { ?>
<script type="text/javascript">
function check() {
var l;
var f;
f = 'title';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('请填写简历名称', f);
return false;
}
f = 'catid_1';
if(Dd(f).value == 0) {
Dmsg('请选择求职行业', 'catid', 1);
return false;
}
f = 'truename';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('请填写真实姓名', f);
return false;
}
f = 'areaid_1';
if(Dd(f).value == 0) {
Dmsg('请选择居住地区', 'areaid', 1);
return false;
}
f = 'byear';
if(Dd(f).value.length != 4) {
Dmsg('请填写生日', f);
return false;
}
f = 'school';
if(Dd(f).value.length < 2) {
Dmsg('请填写毕业院校', f);
return false;
}
f = 'experience';
if(Dd(f).value.length < 1) {
Dmsg('请填写工作经验', f);
return false;
}
f = 'mobile';
if(Dd(f).value.length < 7) {
Dmsg('请填写联系手机', f);
return false;
}
f = 'email';
if(Dd(f).value.length < 6) {
Dmsg('请填写电子邮件', f);
return false;
}
f = 'content';
l = FCKLen();
if(l < 5) {
Dmsg('自我鉴定最少5字，当前已输入'+l+'字', f);
return false;
}
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
</script>
<?php } ?>
<?php include template('footer', 'member');?>