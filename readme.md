# ImageOptimOnUpload
ImageOptimOnUpload extra for MODX. This extra uses the the [ImageOptim API](https://imageoptim.com/api) to optimize and/or resize, crop images on Upload to the File-Manager.


# Usage
By default the extra just optimizes the images. You can set options to resize, crop etc. in System-Settings:

| setting | default | description |
| --- | --- | --- |
| imageoptimonupload.filetypes | jpeg,png,gif,bmp | Comma separatet list of filetypes to process. |
| imageoptimonupload.options |  | Comma separatet list of ImageOptim Options. Ex. 3000 or 100x100,crop. See [Documentation](https://imageoptim.com/api/post#options) |
| imageoptimonupload.username |  | To use this extra, you need to get a (currently free) api username from [https://imageoptim.com/api/username](https://imageoptim.com/api/username) |


# Issues
If you are using some extras to manipulate the filenames on upload (fileSluggy etc.). Make shure, that the Plugin-Priority of the System-Event "OnFileManagerUpload" is higher than the Priority of imageOptimOnUpload.

For example:

```
fileSluggy: OnFileManagerUpload -> Priority = 1

ImageOptimOnUpload: OnFileManagerUpload -> Priority = 0
```
