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
$directory = $modx->event->params['directory'];

// get filename
$fileName = $file['name'];

// get id of default_media_source
$defaultMediaSource = $modx->getOption('default_media_source');

// get modMediaSource object using default_media_source id
$mediaSource = $modx->getObject('modMediaSource', array('id' => $defaultMediaSource ));

// get modMediaSource properties
$mediaSourceProps = $mediaSource->get('properties');
$mediaSourceBasePath = $mediaSourceProps['basePath']['value'];

// create Full-size master image URL
$sourceImageUrl = MODX_SITE_URL . $mediaSourceBasePath . $directory . $fileName;
$sourceImagePath = MODX_BASE_PATH . $mediaSourceBasePath . $directory . $fileName;

// create target image path
$targetImagePath = MODX_BASE_PATH . $mediaSourceBasePath . $directory . $fileName;

// upload image if filetype is in list
if (in_array($file['type'], $fileTypeArray)) {

    // optimize image
    $image = new ImageOptimOnUpload($modx);
    $image->optim($sourceImageUrl, $sourceImagePath, $targetImagePath);
}

return true;
