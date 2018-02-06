<?php
if ($modx->Event->name != 'OnFileManagerUpload') return;


// configs / settings
$username = $modx->getOption('imageoptimonupload.username');
$options = $modx->getOption('imageoptimonupload.options');
$fileTypeArray = explode(",", $modx->getOption('imageoptimonupload.filetypes'));


// prefix fileTypeArray values with "image/" to "image/jpg etc."
array_walk($fileTypeArray, function(&$value, $key) { $value = 'image/' . $value; } );

// get the file
$file = $modx->event->params['files']['file']; 

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

// create target image path
$targetImagePath = MODX_BASE_PATH . $mediaSourceBasePath . $directory . $fileName;


if (in_array($file['type'], $fileTypeArray)) { 

    // Settings needed to switch to the POST method
    $postContext = stream_context_create([
        'http' => [
            'method' => 'POST',
        ],
    ]);
    
    // get image data from the API
    $imageData = file_get_contents(
        'https://im2.io/' . $username . '/' . $options . '/' . $sourceImageUrl,
        false, $postContext);
    
    if ($http_response_header[0] == 'HTTP/1.1 200 OK') {
        // $imageData contains resized/optimized image
        // save it to the disk on the server
        file_put_contents($targetImagePath, $imageData);
    }else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, 'imageOptimOnUpload (API Error): ' . var_dump($http_response_header));
    }
}   

return true;