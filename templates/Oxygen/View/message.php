<?php $this->layout('main') ?>

	<div class="main-head">
<?php

	if (!empty($forum_page['main_head_options']))
		echo "\n\t\t".'<p class="options">'.implode(' ', $forum_page['main_head_options']).'</p>';

?>
		<h2 class="hn"><span><?php echo $heading ?></span></h2>
	</div>

	<div class="main-content main-message">
		<p><?php echo $message ?><?php if ($link != '') echo ' <span>'.$link.'</span>' ?></p>
	</div>
