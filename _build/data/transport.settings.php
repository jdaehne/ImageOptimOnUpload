<?php
/**
 * systemSettings transport file for imageoptimonupload extra
 *
 * Copyright 2018 by Quadro - Jan Dähne <https://www.quadro-system.de>
 * Created on 02-05-2018
 *
 * @package imageoptimonupload
 * @subpackage build
 */

if (! function_exists('stripPhpTags')) {
    function stripPhpTags($filename) {
        $o = file_get_contents($filename);
        $o = str_replace('<' . '?' . 'php', '', $o);
        $o = str_replace('?>', '', $o);
        $o = trim($o);
        return $o;
    }
}
/* @var $modx modX */
/* @var $sources array */
/* @var xPDOObject[] $systemSettings */


$systemSettings = array();

$systemSettings[1] = $modx->newObject('modSystemSetting');
$systemSettings[1]->fromArray(array (
  'key' => 'imageoptimonupload.filetypes',
  'value' => 'jpeg,png,gif,bmp',
  'xtype' => 'textfield',
  'namespace' => 'imageoptimonupload',
  'area' => '',
  'name' => 'File-Types',
  'description' => 'Comma separatet list of filetypes to process.',
), '', true, true);
$systemSettings[2] = $modx->newObject('modSystemSetting');
$systemSettings[2]->fromArray(array (
  'key' => 'imageoptimonupload.options',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'imageoptimonupload',
  'area' => '',
  'name' => 'ImageOptim Options',
  'description' => 'Comma separatet list of ImageOptim Options. Ex. 3000 or 100x100,crop. See documentation: <a href="https://imageoptim.com/api/post" target="_blank">https://imageoptim.com/api/post</a>',
), '', true, true);
$systemSettings[3] = $modx->newObject('modSystemSetting');
$systemSettings[3]->fromArray(array (
  'key' => 'imageoptimonupload.username',
  'value' => '',
  'xtype' => 'textfield',
  'namespace' => 'imageoptimonupload',
  'area' => '',
  'name' => 'ImageOptim Username',
  'description' => 'ImageOptim API Username: <a href="https://imageoptim.com/api/username" target="_blank">https://imageoptim.com/api/username</a>',
), '', true, true);
return $systemSettings;
