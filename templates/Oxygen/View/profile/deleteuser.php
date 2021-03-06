<?php $this->layout('profile', ['forum_page' => $forum_page]) ?>

<?php $this->start('profile') ?>

<?php  ($hook = \Punbb\ForumFunction::get_hook('pf_delete_user_output_start')) ? eval($hook) : null; ?>

	<div class="main-head">
		<h2 class="hn"><span><?php printf(($forum_user['id'] == $id) ? $lang_profile['Profile welcome'] : $lang_profile['Profile welcome user'], \Punbb\ForumFunction::forum_htmlencode($user['username'])) ?></span></h2>
	</div>
	<div class="main-content main-frm">
		<div class="ct-box warn-box">
			<ul class="info-list">
				<?php echo implode("\n\t\t\t\t", $forum_page['frm_info'])."\n" ?>
			</ul>
		</div>
		<form class="frm-form" method="post" accept-charset="utf-8" action="<?php echo $forum_page['form_action'] ?>">
			<div class="hidden">
				<input type="hidden" name="csrf_token" value="<?php echo \Punbb\ForumFunction::generate_form_token($forum_page['form_action']) ?>" />
			</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_\Punbb\ForumFunction::delete_user_pre_fieldset')) ? eval($hook) : null; ?>
			<fieldset class="frm-group group<?php echo ++$forum_page['group_count'] ?>">
				<legend class="group-legend"><strong><?php echo $lang_common['Required information'] ?></strong></legend>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_delete_user_pre_confirm_checkbox')) ? eval($hook) : null; ?>
				<div class="sf-set set<?php echo ++$forum_page['item_count'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page['fld_count'] ?>" name="delete_posts" value="1" checked="checked" /></span>
						<label for="fld<?php echo $forum_page['fld_count'] ?>"><span><?php echo $lang_profile['Delete posts'] ?></span> <?php printf($lang_profile['Delete posts label'], \Punbb\ForumFunction::forum_htmlencode($user['username'])) ?></label>
					</div>
				</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_delete_user_pre_fieldset_end')) ? eval($hook) : null; ?>
			</fieldset>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_delete_user_fieldset_end')) ? eval($hook) : null; ?>
			<div class="frm-buttons">
				<span class="submit primary caution"><input type="submit" name="Fdelete_user_comply" value="<?php echo $lang_profile['Delete user'] ?>" /></span>
				<span class="cancel"><input type="submit" name="cancel" value="<?php echo $lang_common['Cancel'] ?>" formnovalidate /></span>
			</div>
		</form>
	</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('pf_delete_user_end')) ? eval($hook) : null; ?>

<?php $this->stop() ?>	