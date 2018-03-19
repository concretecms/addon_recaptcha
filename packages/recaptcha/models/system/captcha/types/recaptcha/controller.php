<?

class RecaptchaSystemCaptchaTypeController extends SystemCaptchaTypeController {
	
	public function saveOptions($args) {
		$pkg = Package::getByHandle('recaptcha');
		$pkg->saveConfig('CAPTCHA_RECAPTCHA_SITE_KEY', $args['CAPTCHA_RECAPTCHA_SITE_KEY']);
		$pkg->saveConfig('CAPTCHA_RECAPTCHA_SECRET_KEY', $args['CAPTCHA_RECAPTCHA_SECRET_KEY']);
	}

	public function display() {
		$v = View::getInstance();
		$v->addFooterItem('<script src=\'https://www.google.com/recaptcha/api.js\'></script>');
		$pkg = Package::getByHandle('recaptcha');
		$key = $pkg->config('CAPTCHA_RECAPTCHA_SITE_KEY');
		print '<div class="g-recaptcha" data-sitekey="' . $key . '"></div>';
	}
	
	public function label() {
		$form = Loader::helper('form');
		print $form->label('captcha', t('Verify yourself.'));
	}
	
	public function showInput() {}

	public function check() {

		$pkg = Package::getByHandle('recaptcha');
		$response = $_POST['g-recaptcha-response'];
		$secret = $pkg->config('CAPTCHA_RECAPTCHA_SECRET_KEY');
		$ip = $_SERVER['REMOTE_ADDR'];

		$qsa = http_build_query(
			array(
				'secret' => $secret,
				'response' => $response,
				'remoteip' => $ip
			)
		);

		$ch = curl_init('https://www.google.com/recaptcha/api/siteverify?' . $qsa);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);

		if ($response !== false) {
			$data = json_decode($response, true);
			return $data['success'];
		}

		return false;
	}

}