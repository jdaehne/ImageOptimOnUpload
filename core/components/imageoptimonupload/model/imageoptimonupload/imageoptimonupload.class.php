<?php

class ImageOptimOnUpload {

    public $modx;

    /**
     * ImageOptimOnUpload constructor
     *
     * @param MODX A reference to the MODX instance.
     */
     public function __construct(modX &$modx)
     {
        // init modx
        $this->modx = & $modx;

        // config
        $this->username = $this->modx->getOption('imageoptimonupload.username');
        $this->options = $this->modx->getOption('imageoptimonupload.options');
        $this->filetypes = $this->modx->getOption('imageoptimonupload.filetypes');
    }


    // upload and otimize image
    public function optim($sourceImageUrl, $sourceImagePath, $targetImagePath, $options = NULL)
    {
        // if options is empty use system settings
        $options = (empty($options)) ? $this->options : $options;

        // Settings needed to switch to the POST method
        $postContext = stream_context_create([
            'http' => [
                'method' => 'POST',
            ],
        ]);

        // get image data from the API
        $imageData = @file_get_contents(
            'https://im2.io/' . $this->username . '/' . $options . '/' . $sourceImageUrl,
            false, $postContext);

        if ($http_response_header[0] == 'HTTP/1.1 200 OK') {

            // $imageData contains resized/optimized image
            // save image
            @file_put_contents($targetImagePath, $imageData);

        }else {
            // on local or protected enviroment use upload instead of post
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://im2.io/' . $this->username . '/' . $options);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, [
                'file' => curl_file_create($sourceImagePath),
            ]);
            $imageData = curl_exec($ch);
            $responseInfo = curl_getinfo($ch);
            curl_close($ch);

            if ($responseInfo['http_code'] == 200) {
                // save image
                if (@file_put_contents($targetImagePath, $imageData) === false) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'imageOptimOnUpload could not write cache file at '.$targetImagePath);
                }
            }else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'imageOptimOnUpload (API Error): ' . var_dump($imageData));
            }
        }

        return true;
    }

}
