<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class RecaptchaPackage extends Package {

	protected $pkgHandle = 'recaptcha';
	protected $appVersionRequired = '5.5.0b1';
	protected $pkgVersion = '1.0';
	
	public function getPackageDescription() {
		return t("Adds reCAPTCHA as a captcha option.");
	}
	
	public function getPackageName() {
		return t("reCAPTCHA");
	}
	
	public function install() {
		$pkg = parent::install();
		Loader::model('system/captcha/library');
		SystemCaptchaLibrary::add('recaptcha', t('reCAPTCHA'), $pkg);		
	}
	
}