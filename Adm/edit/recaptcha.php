<?php
/**
 * @version:
 * @package: SobiPro Template
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
?>
<div class="col width-70" style="float: left;">
	<fieldset class="adminform" style="border: 1px dashed silver;">
		<legend>
			<?php $this->txt( 'SW_RECAPTCHA_PARAMS' ); ?>
		</legend>
		<table class="admintable">
			<tr class="row<?php echo ++$row%2; ?>">
				<td class="key">
					<?php $this->txt( 'SW_RECAPTCHA_PUBLIC' ); ?>
				</td>
				<td>
					<?php $this->field( 'text', 'field.public_key', 'value:field.public_key', 'id=field_public_key, size=50, maxlength=50, class=inputbox, style=text-align:left;' ); ?>
				</td>
			</tr>
			<tr class="row<?php echo ++$row%2; ?>">
				<td class="key">
					<?php $this->txt( 'SW_RECAPTCHA_PRIVATE' ); ?>
				</td>
				<td>
					<?php $this->field( 'text', 'field.private_key', 'value:field.private_key', 'id=field_private_key, size=50, maxlength=50, class=inputbox, style=text-align:left;' ); ?>
				</td>
			</tr>
			<tr class="row<?php echo ++$row%2; ?>">
				<td class="key">
					<?php $this->txt( 'SW_RECAPTCHA_TEMPLATE' ); ?>
				</td>
				<td>
					<?php $this->field( 'select', 'field.recaptcha_template',
						array( 'red' => 'red', 'white' => 'white', 'blackglass' => 'blackglass', 'clean' => 'clean'),
						'value:field.recaptcha_template', false, array( 'id' => 'recaptcha_template', 'size' => 1,
						'class' => 'inputbox' ) ); ?>
				</td>
			</tr>
			<tr class="row<?php echo ++$row%2; ?>">
				<td class="key">
					<?php $this->txt( 'SW_RECAPTCHA_SSL' ); ?>
				</td>
				<td>
					<?php $this->field( 'states', 'field.ssl', 'value:field.ssl', 'ssl', 'yes_no', 'class=inputbox' ); ?>
				</td>
			</tr>
		</table>
	</fieldset>
</div>