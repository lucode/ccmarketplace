<?php

/**
*
* CCMarketplace - Classified Ads for Joomla!
*
* @package		CCMarketplace
* @subpackage	        Frontend (Send Mail Form)
* @author		Lucas Huber
*
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

JHTML::_('stylesheet', 'ccmarketplace.css', 'components/com_ccmarketplace/assets/');

echo "<h3 id=\"mail_send\">".JText::_("CCMP_MAIL_SEND_MESSAGE")."....</h3>";
?>
<script language="JavaScript" type="text/javascript">
function ltrim(str) {
	for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++);
	return str.substring(k, str.length);
}
function rtrim(str) {
	for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ;
	return str.substring(0,j+1);
}
function trim(str) {
	return ltrim(rtrim(str));
}
function isWhitespace(charToCheck) {
	var whitespaceChars = " \t\n\r\f";
	return (whitespaceChars.indexOf(charToCheck) != -1);
}

function form_validation() {

	var isvalid     = true;

	var name        = document.mailForm.getElementById('name');
	var name_lbl    = document.mailForm.getElementById('name_label');

	var email       = document.mailForm.getElementById('email');
	var email_lbl   = document.mailForm.getElementById('email_label');

	var comment     = document.mailForm.getElementById('comment');
	var comment_lbl = document.mailForm.getElementById('comment_label');

	if(trim(name.value) == '')
	{
		name.style.border     = "1px solid #FF0000";
		name_lbl.style.color  = "#FF0000";
		isvalid				  = false;
	} else {
		name.style.border     = "1px solid #C0C0C0";
		name_lbl.style.color  = "#333333";
		isvalid               = true;
	}

	var evalid   = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(evalid.test(email.value) == false)
	{
		email.style.border     = "1px solid #FF0000";
		email_lbl.style.color  = "#FF0000";
		isvalid				   = false;
	} else {
		email.style.border     = "1px solid #C0C0C0";
		email_lbl.style.color  = "#333333";
		if(isvalid) {
			isvalid            = true;
		}
	}

	if(trim(comment.value) == '')
	{
		comment.style.border     = "1px solid #FF0000";
		comment_lbl.style.color  = "#FF0000";
		isvalid				     = false;
	} else {
		comment.style.border     = "1px solid #C0C0C0";
		comment_lbl.style.color  = "#333333";
		if(isvalid) {
			isvalid              = true;
		}
	}

	if(isvalid) {
		return true;
	} else {
		return false;
	}
}
</script>
<form method="post" name="mailForm" action="" onsubmit="return form_validation()">
	<table id="mail">
		<tr id="label">
			<td><?php echo JText::_("CCMP_MAIL_SUB") ?></td>
		</tr>
		<tr id="field">
			<td><input type="text" name="mailsubject" id="mailsubject" size="40" value="<?php echo $this->mailsubject; ?>" readonly /></td>
		</tr>
		<tr id="label">
			<td id="name_label"><?php echo JText::_("CCMP_MAIL_NAME") ?><font color="#FF0000">&nbsp;*</font></td>
		</tr>
		<tr id="field">
			<td><input type="text" name="name" id="name" size="40" /></td>
		</tr>
		<tr id="label" >
			<td id="email_label"><?php echo JText::_("CCMP_MAIL_EMAIL") ?><font color="#FF0000">&nbsp;*</font></td>
		</tr>
		<tr id="field">
			<td><input type="text" name="email" id="email" size="40" /></td>
		</tr>
		<tr id="label">
			<td id="comment_label"><?php echo JText::_("CCMP_MAIL_COMMENT") ?><font color="#FF0000">&nbsp;*</font></td>
		</tr>
		<tr id="field">
			<td><textarea name="comment" id="comment"></textarea></td>
		</tr>
		<tr id="mail_button">
			<td style="width: 30%;"><input type="submit" class="button"  style="width: 80%;" value="<?php echo JText::_("CCMP_MAIL_SENDMAIL") ?>"></td>
		</tr>
	</table>
	<input type="hidden" name="mailid" value="<?php echo $this->mailid; ?>" />
	<input type="hidden" name="pview" value="<?php echo $this->pview; ?>" />
	<input type="hidden" name="playout" value="<?php echo @$this->playout; ?>" />
	<input type="hidden" name="pmeid" value="<?php echo @$this->pmeid; ?>" />
	<input type="hidden" name="task" value="send_mail" />
	<input type="hidden" name="option" value="<?php echo $_REQUEST['option'] ?>">
	<input type="hidden" name="view" value="mail">
	<input type="hidden" name="id" value="<?php echo $this->pid; ?>">
	<input type="hidden" name="Itemid" value="<?php echo $_REQUEST['Itemid'] ?>">
</form>
<!-- ********** BEGIN Back Button ************** -->
<div id="ccmarketplace_dview3_back" class="default_member">

		<div title=<?php echo JText::_('CCMP_BACK'); ?>>

		<form><input type="button"  value=""onclick="history.go(-1);return false;"/></form>  

	   </div>

	 </div>  
<!-- <p><?php echo JText::_("CCMP_MEMBER_DISABLE_MAIL") ?></p> -->