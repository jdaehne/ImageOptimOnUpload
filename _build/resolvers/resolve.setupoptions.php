<?php
/**
 * Resolve setup options
 *
 * @package imageoptimonupload
 * @subpackage build
 *
 * @var array $options
 * @var xPDOObject $object
 */
$success = false;

if ($object->xpdo) {
    /** @var xPDO $modx */
    $modx =& $object->xpdo;

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var modSystemSetting $setting */
            $setting = $modx->getObject('modSystemSetting', array(
                'key' => 'imageoptimonupload.username'
            ));
            if ($setting != null) {
                $setting->set('value', $modx->getOption('username', $options, ''));
                $setting->save();
            } else {
                $modx->log(xPDO::LOG_LEVEL_ERROR, 'The imageoptimonupload.username system setting was not found and can\'t be updated.');
            }

            $setting = $modx->getObject('modSystemSetting', array(
                'key' => 'imageoptimonupload.options'
            ));
            if ($setting != null) {
                $setting->set('value', $modx->getOption('options', $options, ''));
                $setting->save();
            } else {
                $modx->log(xPDO::LOG_LEVEL_ERROR, 'The imageoptimonupload.options system setting was not found and can\'t be updated.');
            }

            $success = true;
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $success = true;
            break;
    }
}
return $success;
