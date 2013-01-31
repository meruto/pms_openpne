<?php use_javascript('/js/jquery.min.js') ?>
<?php use_javascript('/opHostingBetaPlugin/js/limit_check.js') ?>

<?php slot('submenu'); ?>
<?php include_partial('submenu'); ?>
<?php end_slot(); ?>

<h2><?php echo __('Send invitation message') ?></h2>

<p><?php echo __('Enter email addresses of people to invite to %1%.', array('%1%' => $op_config['sns_name'])) ?></p>
<p><?php echo __('Please enter one email address per line.') ?></p>


<form action="<?php echo url_for('member/invite') ?>" method="post">
<table>
<?php echo $form ?>
<tr>
<td colspan="2"><input id="inviteMemberButton" type="submit" value="<?php echo __('Send') ?>" disabled="disabled"/></td>
</tr>
</table>
</form>


