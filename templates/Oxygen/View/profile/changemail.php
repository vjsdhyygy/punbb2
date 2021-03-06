<?php $this->layout('profile', ['forum_page' => $forum_page]) ?>

<?php $this->start('profile') ?>


<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_output_start')) ? eval($hook) : null; ?>
	<div class="main-head">
		<h2 class="hn"><span><?php printf(($forum_user['id'] == $id) ? $lang_profile['Profile welcome'] : $lang_profile['Profile welcome user'], \Punbb\ForumFunction::forum_htmlencode($user['username'])) ?></span></h2>
	</div>
	<div class="main-content main-frm">
		<div class="ct-box info-box">
			<?php echo $forum_page['frm_info']."\n" ?>
		</div>
<?php

	// If there were any errors, show them
	if (!empty($errors))
	{
		$forum_page['errors'] = array();
		foreach ($errors as $cur_error)
			$forum_page['errors'][] = '<li class="warn"><span>'.$cur_error.'</span></li>';

		($hook = \Punbb\ForumFunction::get_hook('pf_change_email_pre_errors')) ? eval($hook) : null;

?>
		<div class="ct-box error-box">
			<h2 class="warn hn"><?php echo $lang_profile['Change e-mail errors'] ?></h2>
			<ul class="error-list">
				<?php echo implode("\n\t\t\t\t", $forum_page['errors'])."\n" ?>
			</ul>
		</div>
<?php

	}

?>
		<div id="req-msg" class="req-warn ct-box error-box">
			<p class="important"><?php echo $lang_common['Required warn'] ?></p>
		</div>
		<form id="afocus" class="frm-form" method="post" accept-charset="utf-8" action="<?php echo $forum_page['form_action'] ?>">
			<div class="hidden">
				<?php echo implode("\n\t\t\t", $forum_page['hidden_fields'])."\n" ?>
			</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_pre_fieldset')) ? eval($hook) : null; ?>
			<fieldset class="frm-group group<?php echo ++$forum_page['group_count'] ?>">
				<legend class="group-legend"><strong><?php echo $lang_common['Required information'] ?></strong></legend>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_pre_new_email')) ? eval($hook) : null; ?>
				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page['fld_count'] ?>"><span><?php echo $lang_profile['New e-mail'] ?></span></label><br />
						<span class="fld-input"><input type="email" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_new_email" size="35" maxlength="80" value="<?php if (isset($_POST['req_new_email'])) echo \Punbb\ForumFunction::forum_htmlencode($_POST['req_new_email']); ?>" required /></span>
					</div>
				</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_pre_password')) ? eval($hook) : null; ?>
				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page['fld_count'] ?>"><span><?php echo $lang_profile['Password'] ?></span><small><?php echo $lang_profile['Old password help'] ?></small></label><br />
						<span class="fld-input"><input type="<?php echo($forum_config['o_mask_passwords'] == '1' ? 'password' : 'text') ?>" id="fld<?php echo $forum_page['fld_count'] ?>" name="req_password" size="35" value="<?php if (isset($_POST['req_password'])) echo \Punbb\ForumFunction::forum_htmlencode($_POST['req_password']); ?>" required autocomplete="off" /></span>
					</div>
				</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_pre_fieldset_end')) ? eval($hook) : null; ?>
			</fieldset>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_fieldset_end')) ? eval($hook) : null; ?>
			<div class="frm-buttons">
				<span class="submit primary"><input type="submit" name="update" value="<?php echo $lang_common['Submit'] ?>" /></span>
				<span class="cancel"><input type="submit" name="cancel" value="<?php echo $lang_common['Cancel'] ?>" formnovalidate /></span>
			</div>
		</form>
	</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_change_email_normal_end')) ? eval($hook) : null; ?>

<?php $this->stop() ?>	