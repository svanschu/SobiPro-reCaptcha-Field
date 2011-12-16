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
	protected $form_type = "Ajax";
	/**
	 * @var string
	 */
	protected $recaptcha_template = "white";

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

		/*SPLang::load( 'SpApp.recaptcha' );
		if (strlen($this->atText) == 0)
			$this->atText = Sobi::Txt( 'AFA_ADD_NEW');*/
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
		require_once(JPATH_COMPONENT.'lib/recaptcha/recaptchalib.php');
		$captcha = recaptcha_get_html($this->public_key);
		if (!$return) {
			echo $captcha;
		}
		else {
			return $captcha;
		}
	}
}