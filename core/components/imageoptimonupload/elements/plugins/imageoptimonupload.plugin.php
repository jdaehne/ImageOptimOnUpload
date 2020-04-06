<?php
/*
 * imageoptimonupload
 *
 *
 * @author Jan Dähne, Quadro <jan.daehne@quadro-system.de>
 */

if ($modx->event->name != 'OnFileManagerUpload') return;

// load Class
$path = $modx->getOption('imageoptimonupload.core_path', null, $modx->getOption('core_path') . 'components/imageoptimonupload/');
$path .= 'model/imageoptimonupload/';
$clientConfig = $modx->getService('imageoptimonupload','ImageOptimOnUpload', $path);

// configs / settings
$fileTypeArray = explode(",", $modx->getOption('imageoptimonupload.filetypes'));

// prefix fileTypeArray values with "image/" to "image/jpg etc."
array_walk($fileTypeArray, function(&$value, $key) { $value = 'image/' . $value; } );

// get the file
$file = reset($files);

// abort on error
if ($file['error']  !=  0) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'imageOptimOnUpload: $file["error"] occured.');
    return;
}

// get upload directory from OnFileManagerUpload event
$directory = ltrim($modx->event->params['directory'], '/');

// get filename
$fileName = $file['name'];

// get modMediaSource baseUrl
$mediaSourceBaseUrl = ltrim($source->getBaseUrl(), '/');
$mediaSourceBasePath = $source->getBasePath();

// create Full-size master image URL
$sourceImageUrl = MODX_SITE_URL . $mediaSourceBaseUrl . $directory . $fileName;
$sourceImagePath = $mediaSourceBasePath . $directory . $fileName;

// create target image path
$targetImagePath = $mediaSourceBasePath . $directory . $fileName;

// upload image if filetype is in list
if (in_array($file['type'], $fileTypeArray)) {

    // optimize image
    $image = new ImageOptimOnUpload($modx);
    $image->optim($sourceImageUrl, $sourceImagePath, $targetImagePath);
}

return true;