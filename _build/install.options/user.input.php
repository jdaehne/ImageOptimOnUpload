<?php

/**
 * Script to interact with user during imageoptimonupload package install
 *
 * Copyright 2014 by Quadro - Jan Dähne <https://www.quadro-system.de>
 * Created on 02-05-2018
 *
 * imageoptimonupload is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * imageoptimonupload is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * imageoptimonupload; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package imageoptimonupload
 */

/**
 * Description: Script to interact with user during imageoptimonupload package install
 * @package imageoptimonupload
 * @subpackage build
 */

/* The return value from this script should be an HTML form (minus the
 * <form> tags and submit button) in a single string.
 *
 * The form will be shown to the user during install
 *
 * This example presents an HTML form to the user with two input fields
 * (you can have as many as you like).
 *
 * The user's entries in the form's input field(s) will be available
 * in any php resolvers with $modx->getOption('field_name', $options, 'default_value').
 *
 * You can use the value(s) to set system settings, snippet properties,
 * chunk content, etc. based on the user's preferences.
 *
 * One common use is to use a checkbox and ask the
 * user if they would like to install a resource for your
 * component (usually used only on install, not upgrade).
 */

/* This is an example. Modify it to meet your needs.
 * The user's input would be available in a resolver like this:
 *
 * $changeSiteName = (! empty($modx->getOption('change_sitename', $options, ''));
 * $siteName = $modx->getOption('sitename', $options, '').
 *
 * */

 $setting = $modx->getObject('modSystemSetting',array('key' => 'imageoptimonupload.username'));
 if ($setting != null) {
     $values['username'] = $setting->get('value');
 }
 unset($setting);


$output = '<style>.field_desc { color: #A0A0A0; font-size: 11px; font-style: italic; }</style>
<label for="username">ImageOptim API Username:</label>
<input type="text" name="username" id="username" value="'.$values['username'].'" align="left" size="40" maxlength="60" />
<div class="field_desc">Setup Username: <a href="https://imageoptim.com/api/username" target="_blank">https://imageoptim.com/api/username</a></div>';


return $output;
