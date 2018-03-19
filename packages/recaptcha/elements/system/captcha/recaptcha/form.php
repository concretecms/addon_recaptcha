<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

$form = Loader::helper('form');
$pkg = Package::getByHandle('recaptcha');
?>

<div class="clearfix">
	<?=$form->label('CAPTCHA_RECAPTCHA_SITE_KEY', t('Site Key'))?>
	<div class="input">
		<?=$form->text('CAPTCHA_RECAPTCHA_SITE_KEY', $pkg->config('CAPTCHA_RECAPTCHA_SITE_KEY'), array('class' => 'span6'))?>
	</div>
</div>

<div class="clearfix">
	<?=$form->label('CAPTCHA_RECAPTCHA_SECRET_KEY', t('Secret Key'))?>
	<div class="input">
		<?=$form->text('CAPTCHA_RECAPTCHA_SECRET_KEY', $pkg->config('CAPTCHA_RECAPTCHA_SECRET_KEY'), array('class' => 'span6'))?>
	</div>
</div>