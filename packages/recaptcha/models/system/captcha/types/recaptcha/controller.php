<?

class RecaptchaSystemCaptchaTypeController extends SystemCaptchaTypeController {
	
	public function saveOptions($args) {
		$pkg = Package::getByHandle('recaptcha');
		$pkg->saveConfig('CAPTCHA_RECAPTCHA_PUBLIC_KEY', $args['CAPTCHA_RECAPTCHA_PUBLIC_KEY']);
		$pkg->saveConfig('CAPTCHA_RECAPTCHA_PRIVATE_KEY', $args['CAPTCHA_RECAPTCHA_PRIVATE_KEY']);
	}

	public function display() {
		$pkg = Package::getByHandle('recaptcha');
		Loader::library('3rdparty/recaptchalib', 'recaptcha');
		print '<style type="text/css">#recaptcha_table label {float: none !important;}</style>';
		print recaptcha_get_html($pkg->config('CAPTCHA_RECAPTCHA_PUBLIC_KEY'));
	}
	
	public function label() {
		$form = Loader::helper('form');
		print $form->label('captcha', t('Verify yourself.'));
	}
	
	public function showInput() {}

	public function check() {
		$pkg = Package::getByHandle('recaptcha');
		Loader::library('3rdparty/recaptchalib', 'recaptcha');
		$resp = recaptcha_check_answer($pkg->config('CAPTCHA_RECAPTCHA_PRIVATE_KEY'),
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]
		);
		return $resp->is_valid;
	}

}