<?php
/*
 * imageOptimOnUploadScan
 *
 * Snippet to Scan images
 *
 * Usage examples:
 * [[imageOptimOnUploadScan? &dir=`uploads/` ...]]
 *
 * @author Jan Dähne <jan.daehne@quadro-system.de>
 */

 // properties
$dir = MODX_ASSETS_PATH . $modx->getOption('dir', $scriptProperties);
$filter = json_decode($modx->getOption('filter', $scriptProperties));

// load Class
$path = $modx->getOption('imageoptimonupload.core_path', null, $modx->getOption('core_path') . 'components/imageoptimonupload/');
$path .= 'model/imageoptimonupload/';
$clientConfig = $modx->getService('imageoptimonupload','ImageOptimOnUpload', $path);

// init imageOptimOnUpload
$io = new ImageOptimOnUpload($modx);

echo '<pre>';
return print_r($io->scanDir($dir, $filter));