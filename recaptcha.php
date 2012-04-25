<?php
/**
 * @package: SobiPro Aggregation Field Application
 * ===================================================
 * @author
 * Name: Sven Schultschik, Schultschik Websolution
 * Email: admin[at]schultschik.de
 * Url: http://www.schultschik.de
 * ===================================================
 * @copyright Copyright (C) 2011 Schultschik Websolution. All rights reserved.
 * @license see http://www.gnu.org/licenses/gpl.html GNU/GPL Version 3.
 * You can use, redistribute this file and/or modify it under the terms of the GNU General Public License version 3
 */

defined( 'SOBIPRO' ) || exit( 'Restricted access' );
SPLoader::loadClass( 'opt.fields.inbox' );
/**
 * @author Sven Schultschik
 * @version 1.0
 * @created 16-Dec-2011
 */
class SPField_reCaptcha extends SPField_Inbox implements SPFieldInterface
{
	/**
	 * @var string
	 */
	protected $public_key = "";
	/**
	 * @var string
	 */
	protected $private_key = "";
	/**
	 * @var string
	 */
	protected $recaptcha_template = 'clean';
	/**
	 * @var bool
	 */
	protected $ssl = 0;

	/**
	* Returns the parameter list
	* @return array
	*/
	protected function getAttr()
	{
		$attr = get_class_vars( __CLASS__ );
		unset( $attr[ '_attr' ] );
		unset( $attr[ '_selected' ] );
		return array_keys( $attr );
	}

	public function __construct ( &$field )
	{
		parent::__construct ($field);
	}

	/**
	* Shows the field in the edit entry or add entry form
	* @param bool $return return or display directly
	* @return string
	*/
	public function field( $return = false )
	{
		if (!($this->enabled)) {
			return false;
		}
		if (!defined('SOBIPRO_ADM')) {
			$lang = JFactory::getLanguage()->getlocale();
			SPFactory::header()->addJsCode( "var RecaptchaOptions = {
				theme : '{$this->recaptcha_template}',
				lang : '{$lang[4]}'
			 };" );
			SPFactory::header()->addJsFile( 'jquery' );
			SPFactory::header()->addJsCode( "jQuery( document ).ready( function() {
				jQuery( '#recaptcha_response_field' )
					.addClass( ' required' )
					.css('border' , '')
			});");
			require_once(SOBI_PATH.'/lib/recaptcha/recaptcha.php');
			$captcha = recaptcha_get_html($this->public_key, null, $this->ssl);
		} else {
			$captcha = "For Backend the reCaptcha is deactivated!";
		}
		if (!$return) {
			echo $captcha;
		}
		else {
			return $captcha;
		}
	}

	/**
		 * Gets the data for a field, verify it and pre-save it.
		 * @param SPEntry $entry
		 * @param string $tsid
		 * @param string $request
		 * @return void
		 */
		public function submit( &$entry, $tsid = null, $request = 'POST' )
		{
			if (!defined('SOBIPRO_ADM')) {
				SPLang::load( 'SpApp.recaptcha' );
				$data = SPRequest::string( "recaptcha_response_field" , null, false, $request );
				if ( !( strlen( $data ) ) ) {
					throw new SPException( SPLang::e( 'SW_FIELD_REQUIRED_ERR', $this->name ) );
				}
				require_once(SOBI_PATH.'/lib/recaptcha/recaptcha.php');
				$resp = recaptcha_check_answer ($this->private_key,
						SPRequest::string( "REMOTE_ADDR", null, false, 'SERVER' ),
						SPRequest::string( "recaptcha_challenge_field" , null, false, $request ),
						$data);

				if (!$resp->is_valid) {
					// What happens when the CAPTCHA was entered incorrectly
					throw new SPException( SPLang::e( 'SW_FIELD_RECAPTCHA_ERR', $resp->error ) );
				}
			}
		}
}