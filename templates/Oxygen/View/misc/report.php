<?php $this->layout('main') ?>

<?php ($hook = \Punbb\ForumFunction::get_hook('mi_report_output_start')) ? eval($hook) : null; ?>
	<div class="main-head">
		<h2 class="hn"><span><?= $forum_page['main_head'] ?></span></h2>
	</div>
	<div class="main-content main-frm">
		<div id="req-msg" class="req-warn ct-box error-box">
			<p class="important"><?= $lang_common['Required warn'] ?></p>
		</div>
<?php
		// If there were any errors, show them
		if (!empty($errors)) {
			$forum_page['errors'] = array();
			foreach ($errors as $cur_error) {
				$forum_page['errors'][] = '<li class="warn"><span>'.$cur_error.'</span></li>';
			}

			($hook = \Punbb\ForumFunction::get_hook('mi_pre_report_errors')) ? eval($hook) : null;
?>
		<div class="ct-box error-box">
			<h2 class="warn hn"><?= $lang_misc['Report errors'] ?></h2>
			<ul class="error-list">
				<?= implode("\n\t\t\t\t", $forum_page['errors'])."\n" ?>
			</ul>
		</div>
<?php
		}
?>
		<form id="afocus" class="frm-form" method="post" accept-charset="utf-8" action="<?= $forum_page['form_action'] ?>">
			<div class="hidden">
				<?= implode("\n\t\t\t\t", $forum_page['hidden_fields'])."\n" ?>
			</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('mi_report_pre_fieldset')) ? eval($hook) : null; ?>
			<fieldset class="frm-group group<?= ++$forum_page['group_count'] ?>">
				<legend class="group-legend"><strong><?= $lang_common['Required information'] ?></strong></legend>
<?php ($hook = \Punbb\ForumFunction::get_hook('mi_report_pre_reason')) ? eval($hook) : null; ?>
				<div class="txt-set set<?= ++$forum_page['item_count'] ?>">
					<div class="txt-box textarea required">
						<label for="fld<?= ++$forum_page['fld_count'] ?>"><span><?= $lang_misc['Reason'] ?></span> <small><?= $lang_misc['Reason help'] ?></small></label><br />
						<div class="txt-input"><span class="fld-input"><textarea id="fld<?= $forum_page['fld_count'] ?>" name="req_reason" rows="5" cols="60" required></textarea></span></div>
					</div>
				</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('mi_report_pre_fieldset_end')) ? eval($hook) : null; ?>
			</fieldset>
<?php ($hook = \Punbb\ForumFunction::get_hook('mi_report_fieldset_end')) ? eval($hook) : null; ?>
			<div class="frm-buttons">
				<span class="submit primary"><input type="submit" name="submit" value="<?= $lang_common['Submit'] ?>" /></span>
				<span class="cancel"><input type="submit" name="cancel" value="<?= $lang_common['Cancel'] ?>" formnovalidate /></span>
			</div>
		</form>
	</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('mi_report_end')) ? eval($hook) : null; ?>
