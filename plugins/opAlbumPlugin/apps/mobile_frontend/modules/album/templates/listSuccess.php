<?php op_mobile_page_title(__('Most Recent'))?>
<?php if ($pager->getNbResults()): ?>
<?php include_partial('list', array('pager' => $pager)) ?>
<?php op_include_pager_navigation($pager, '@album_list?page=%d', array('is_total' => false)); ?>
<?php else: ?>
<?php echo __('There are no albums.') ?>
<hr color="<?php echo $op_color["core_color_11"] ?>" size="3">
<?php endif; ?>
<?php echo link_to(__('My Albums'), 'album_list_mine') ?><br>
<?php echo link_to(__('Friend Albums'), 'album_list_friend') ?><br>
