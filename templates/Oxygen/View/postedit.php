<?php $this->layout('main') ?>

<?php ($hook = \Punbb\ForumFunction::get_hook('ed_main_output_start')) ? eval($hook) : null; ?>
	<div class="main-head">
		<h2 class="hn"><span><?=  ($id == $cur_post['first_post_id']) ? $lang_post['Edit topic'] : $lang_post['Edit reply'] ?></span></h2>
	</div>
<?php

$forum_page['group_count'] = $forum_page['item_count'] = $forum_page['fld_count'] = 0;

// If preview selected and there are no errors
if (isset($_POST['preview']) && empty($errors))
{
	if (!defined('FORUM_PARSER_LOADED'))
		require FORUM_ROOT.'include/parser.php';

	// Generate the post heading
	$forum_page['post_ident'] = array();
	$forum_page['post_ident']['num'] = '<span class="post-num">#</span>';
	$forum_page['post_ident']['byline'] = '<span class="post-byline">'.sprintf((($id == $cur_post['first_post_id']) ? $lang_post['Topic byline'] : $lang_post['Reply byline']), '<strong>'.\Punbb\ForumFunction::forum_htmlencode($cur_post['poster']).'</strong>').'</span>';
	$forum_page['post_ident']['link'] = '<span class="post-link">'.\Punbb\ForumFunction::format_time(time()).'</span>';

	$forum_page['preview_message'] = parse_message($message, $hide_smilies);

	($hook = \Punbb\ForumFunction::get_hook('ed_preview_pre_display')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?=  $id == $cur_post['first_post_id'] ? $lang_post['Preview edited topic'] : $lang_post['Preview edited reply'] ?></span></h2>
	</div>
	<div id="post-preview" class="main-content main-frm">
		<div class="post singlepost">
			<div class="posthead">
				<h3 class="hn"><?=  implode(' ', $forum_page['post_ident']) ?></h3>
<?php ($hook = \Punbb\ForumFunction::get_hook('ed_preview_new_post_head_option')) ? eval($hook) : null; ?>
			</div>
			<div class="postbody">
				<div class="post-entry">
					<div class="entry-content">
						<?=  $forum_page['preview_message']."\n" ?>
					</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('ed_preview_new_post_entry_data')) ? eval($hook) : null; ?>
				</div>
			</div>
		</div>
	</div>
<?php

}

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?=  ($id != $cur_post['first_post_id']) ? $lang_post['Compose edited reply'] : $lang_post['Compose edited topic'] ?></span></h2>
	</div>
	<div id="post-form" class="main-content main-frm">
<?php

	if (!empty($forum_page['text_options']))
		echo "\t\t".'<p class="ct-options options">'.sprintf($lang_common['You may use'], implode(' ', $forum_page['text_options'])).'</p>'."\n";

// If there were any errors, show them
if (!empty($errors))
{

?>
		<div class="ct-box error-box">
			<h2 class="warn hn"><span><?=  $lang_post['Post errors'] ?></span></h2>
			<ul class="error-list">
			<?php foreach ($errors as $cur_error) : ?>
				<li><span><?= $cur_error ?></span></li>
			<?php endforeach ?>
			</ul>
		</div>
<?php

}

?>
		<div id="req-msg" class="req-warn ct-box error-box">
			<p class="important"><?=  $lang_common['Required warn'] ?></p>
		</div>
		<form id="afocus" class="frm-form frm-ctrl-submit" method="post" accept-charset="utf-8" action="<?=  $forum_page['form_action'] ?>"<?php if (!empty($forum_page['form_attributes'])) echo ' '.implode(' ', $forum_page['form_attributes']) ?>>
			<div class="hidden">
				<input type="hidden" name="form_sent" value="1" />
				<input type="hidden" name="csrf_token" value="<?= \Punbb\ForumFunction::generate_form_token($forum_page['form_action']) ?>" />
			</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('ed_pre_main_fieldset')) ? eval($hook) : null; ?>
			<fieldset class="frm-group group<?=  ++$forum_page['group_count'] ?>">
				<legend class="group-legend"><strong><?=  $lang_post['Edit post legend'] ?></strong></legend>
<?php ($hook = \Punbb\ForumFunction::get_hook('ed_pre_subject')) ? eval($hook) : null; ?>
<?php if ($can_edit_subject): ?>				<div class="sf-set set<?=  ++$forum_page['item_count'] ?>">
					<div class="sf-box text required">
						<label for="fld<?=  ++ $forum_page['fld_count'] ?>"><span><?=  $lang_post['Topic subject'] ?></span></label><br />
						<span class="fld-input"><input id="fld<?=  $forum_page['fld_count'] ?>" type="text" name="req_subject" size="<?=  FORUM_SUBJECT_MAXIMUM_LENGTH ?>" maxlength="<?=  FORUM_SUBJECT_MAXIMUM_LENGTH ?>" value="<?=  \Punbb\ForumFunction::forum_htmlencode(isset($_POST['req_subject']) ? $_POST['req_subject'] : $cur_post['subject']) ?>" required /></span>
					</div>
				</div>
<?php endif; ($hook = \Punbb\ForumFunction::get_hook('ed_pre_message_box')) ? eval($hook) : null; ?>				<div class="txt-set set<?=  ++$forum_page['item_count'] ?>">
					<div class="txt-box textarea required">
						<label for="fld<?=  ++ $forum_page['fld_count'] ?>"><span><?=  $lang_post['Write message'] ?></span></label>
						<div class="txt-input"><span class="fld-input"><textarea id="fld<?=  $forum_page['fld_count'] ?>" name="req_message" rows="15" cols="95" required spellcheck="true"><?=  \Punbb\ForumFunction::forum_htmlencode(isset($_POST['req_message']) ? $message : $cur_post['message']) ?></textarea></span></div>
					</div>
				</div>
<?php

$forum_page['checkboxes'] = array();
if ($forum_config['o_smilies'] == '1')
{
	if (isset($_POST['hide_smilies']) || $cur_post['hide_smilies'] == '1')
		$forum_page['checkboxes']['hide_smilies'] = '<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld'.(++$forum_page['fld_count']).'" name="hide_smilies" value="1" checked="checked" /></span> <label for="fld'.$forum_page['fld_count'].'">'.$lang_post['Hide smilies'].'</label></div>';
	else
		$forum_page['checkboxes']['hide_smilies'] = '<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld'.(++$forum_page['fld_count']).'" name="hide_smilies" value="1" /></span> <label for="fld'.$forum_page['fld_count'].'">'.$lang_post['Hide smilies'].'</label></div>';
}

if ($forum_page['is_admmod'])
{
	if ((isset($_POST['form_sent']) && isset($_POST['silent'])) || !isset($_POST['form_sent']))
		$forum_page['checkboxes']['silent'] = '<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld'.(++$forum_page['fld_count']).'" name="silent" value="1" checked="checked" /></span> <label for="fld'.$forum_page['fld_count'].'">'.$lang_post['Silent edit'].'</label></div>';
	else
		$forum_page['checkboxes']['silent'] = '<div class="mf-item"><span class="fld-input"><input type="checkbox" id="fld'.(++$forum_page['fld_count']).'" name="silent" value="1" /></span> <label for="fld'.$forum_page['fld_count'].'">'.$lang_post['Silent edit'].'</label></div>';
}

($hook = \Punbb\ForumFunction::get_hook('ed_pre_checkbox_display')) ? eval($hook) : null;

if (!empty($forum_page['checkboxes']))
{

?>
				<fieldset class="mf-set set<?=  ++$forum_page['item_count'] ?>">
					<div class="mf-box checkbox">
						<?=  implode("\n\t\t\t\t\t", $forum_page['checkboxes'])."\n" ?>
					</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('ed_pre_checkbox_fieldset_end')) ? eval($hook) : null; ?>
				</fieldset>
<?php

}

($hook = \Punbb\ForumFunction::get_hook('ed_pre_main_fieldset_end')) ? eval($hook) : null;

?>
			</fieldset>
<?php

($hook = \Punbb\ForumFunction::get_hook('ed_main_fieldset_end')) ? eval($hook) : null;

?>
			<div class="frm-buttons">
				<span class="submit primary"><input type="submit" name="submit_button" value="<?=  ($id != $cur_post['first_post_id']) ? $lang_post['Submit reply'] : $lang_post['Submit topic'] ?>" /></span>
				<span class="submit"><input type="submit" name="preview" value="<?=  ($id != $cur_post['first_post_id']) ? $lang_post['Preview reply'] : $lang_post['Preview topic'] ?>" /></span>
			</div>
		</form>
	</div>
<?php ($hook = \Punbb\ForumFunction::get_hook('ed_end')) ? eval($hook) : null; ?>
