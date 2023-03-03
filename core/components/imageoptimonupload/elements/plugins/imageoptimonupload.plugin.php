<?php
/*
 * imageoptimonupload
 *
 *
 * @author Jan Dähne, Quadro <jan.daehne@quadro-system.de>
 */


// load Class
$path = $modx->getOption('imageoptimonupload.core_path', null, $modx->getOption('core_path') . 'components/imageoptimonupload/');
$path .= 'model/imageoptimonupload/';
$clientConfig = $modx->getService('imageoptimonupload','ImageOptimOnUpload', $path);


switch ($modx->event->name) {
    case 'OnFileManagerUpload':

        // get the file
        $file = reset($files);
        
        // abort on error
        if ($file['error']  !=  0) {
            $source->addError('', 'imageOptimOnUpload: Error on upload.');
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
        
        // initial imageOptim
        $io = new ImageOptimOnUpload($modx);
        
        // checkif if filetype is in list
        if (!$io->checkFileType($file['type'])) return;
        
        // optimize image
        $io = new ImageOptimOnUpload($modx);
        $io->optim($sourceImageUrl, $sourceImagePath, $targetImagePath);

        break;
    

    case 'OnFileManagerBeforeUpload':
        
        $io = new ImageOptimOnUpload($modx);
        
        if (!$modx->getOption('imageoptimonupload.checkfile')) return;
        if ($io->checkFile($file)) return;

        $modx->lexicon->load('imageoptimonupload:default');
        $source->addError('', $modx->lexicon('error.checkfile'));
        
        $file = &$scriptProperties['file'];
        $file['error'] = 1;

        break;
}

return;