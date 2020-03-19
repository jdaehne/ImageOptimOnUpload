<?php
/**
 * Setup options
 *
 * @package imageoptimonupload
 * @subpackage build
 *
 * @var array $options
 * @var xPDOObject $object
 */

$output = '';
$values = array();
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
        $output .= '<h2>Install ImageOptimOnUpload</h2>
        <p>ImageOptimOnUpload will be installed. Please review the install options carefully.</p><br>';

        $output .= '<div id="api">
                        <label for="api_username">API Username:</label>
                        <input type="text" name="username" id="api_username" width="450" value="" />
                    </div>
                    <br><br>';

        $output .= '<div id="options">
                        <label for="image_options">Options:</label>
                        <input type="text" name="options" id="image_options" width="450" value="" />
                    </div>
                    <br><br>';

        break;
    case xPDOTransport::ACTION_UPGRADE:
        $setting = $modx->getObject('modSystemSetting', array('key' => 'imageoptimonupload.username'));
        $values['username'] = ($setting) ? $setting->get('value') : '';
        unset($setting);

        $setting = $modx->getObject('modSystemSetting', array('key' => 'imageoptimonupload.options'));
        $values['options'] = ($setting) ? $setting->get('value') : '';
        unset($setting);

        $output .= '<h2>Upgrade ImageOptimOnUpload</h2>
        <p>ImageOptimOnUpload will be upgraded. Please review the install options carefully.</p><br>';

        $output .= '<div id="api">
                        <label for="api_username">API Username:</label>
                        <input type="text" name="username" id="api_username" width="450" value="' . $values['username'] . '" />
                    </div>
                    <br><br>';

        $output .= '<div id="options">
                        <label for="image_options">Options:</label>
                        <input type="text" name="options" id="image_options" width="450" value="' . $values['options'] . '" />
                    </div>
                    <br><br>';

        break;
    case xPDOTransport::ACTION_UNINSTALL:
        break;
}

return $output;
