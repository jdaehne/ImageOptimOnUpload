<?php

 /*               DO NOT EDIT THIS FILE

  Edit the file in the MyComponent config directory
  and run ExportObjects

 */



$packageNameLower = 'imageoptimonupload'; /* No spaces, no dashes */

$components = array(
    /* These are used to define the package and set values for placeholders */
    'packageName' => 'imageoptimonupload',  /* No spaces, no dashes */
    'packageNameLower' => $packageNameLower,
    'packageDescription' => 'imageoptimonupload project for MyComponent extra',
    'version' => '1.0.0',
    'release' => 'beta1',
    'author' => 'Quadro - Jan Dähne',
    'email' => '<https://www.quadro-system.de>',
    'authorUrl' => 'https://www.quadro-system.de',
    'authorSiteName' => "Quadro",
    'packageDocumentationUrl' => 'https://www.quadro-system.de/modx-extras/imageoptim-on-upload/',
    'copyright' => '2018',

    /* no need to edit this except to change format */
    'createdon' => strftime('%m-%d-%Y'),

    'gitHubUsername' => 'jdaehne',
    'gitHubRepository' => 'ImageOptimOnUpload',

    /* two-letter code of your primary language */
    'primaryLanguage' => 'en',

    /* Set directory and file permissions for project directories */
    'dirPermission' => 0755,  /* No quotes!! */
    'filePermission' => 0644, /* No quotes!! */

    /* Define source and target directories */

    /* path to MyComponent source files */
    'mycomponentRoot' => $this->modx->getOption('mc.root', null,
        MODX_CORE_PATH . 'components/mycomponent/'),

    /* path to new project root */
    'targetRoot' => MODX_ASSETS_PATH . 'mycomponents/' . $packageNameLower . '/',


    /* *********************** NEW SYSTEM SETTINGS ************************ */

    /* If your extra needs new System Settings, set their field values here.
     * You can also create or edit them in the Manager (System -> System Settings),
     * and export them with exportObjects. If you do that, be sure to set
     * their namespace to the lowercase package name of your extra */

    'newSystemSettings' => array(
        'imageoptimonupload.filetypes' => array( // key
            'key' => 'imageoptimonupload.filetypes',
            'name' => 'File-Types',
            'description' => 'Comma separatet list of filetypes to process.',
            'namespace' => 'imageoptimonupload',
            'xtype' => 'textfield',
            'value' => 'jpeg,png,gif,bmp',
            'area' => '',
        ),
        'imageoptimonupload.options' => array( // key
            'key' => 'imageoptimonupload.options',
            'name' => 'ImageOptim Options',
            'description' => 'Comma separatet list of ImageOptim Options. Ex. 3000 or 100x100,crop. See documentation: <a href="https://imageoptim.com/api/post" target="_blank">https://imageoptim.com/api/post</a>',
            'namespace' => 'imageoptimonupload',
            'xtype' => 'textfield',
            'value' => '',
            'area' => '',
        ),
        'imageoptimonupload.username' => array( // key
            'key' => 'imageoptimonupload.username',
            'name' => 'ImageOptim Username',
            'description' => 'Setup ImageOptim API Username: <a href="https://imageoptim.com/api/username" target="_blank">https://imageoptim.com/api/username</a>',
            'namespace' => 'imageoptimonupload',
            'xtype' => 'textfield',
            'value' => '',
            'area' => '',
        ),
    ),

    /* ************************ NAMESPACE(S) ************************* */
    /* (optional) Typically, there's only one namespace which is set
     * to the $packageNameLower value. Paths should end in a slash
    */

    'namespaces' => array(
        'imageoptimonupload' => array(
            'name' => 'imageoptimonupload',
            'path' => '{core_path}components/imageoptimonupload/',
            'assets_path' => '{assets_path}components/imageoptimonupload/',
        ),

    ),




    /* ************************* CATEGORIES *************************** */
    /* (optional) List of categories. This is only necessary if you
     * need to categories other than the one named for packageName
     * or want to nest categories.
    */

    'categories' => array(
        'imageoptimonupload' => array(
            'category' => 'ImageOptimOnUpload',
            'parent' => '',  /* top level category */
        )
    ),

    /* *************************** MENUS ****************************** */




    /* ************************* ELEMENTS **************************** */

    /* Array containing elements for your extra. 'category' is required
       for each element, all other fields are optional.
       Property Sets (if any) must come first!

       The standard file names are in this form:
           SnippetName.snippet.php
           PluginName.plugin.php
           ChunkName.chunk.html
           TemplateName.template.html

       If your file names are not standard, add this field:
          'filename' => 'actualFileName',
    */


    'elements' => array(

        'plugins' => array(
            'ImageOptimOnUpload' => array( /* imageoptimonupload with static, events, and property sets */
                'category' => 'imageoptimonupload',
                'description' => '',
                'static' => false,
                'propertySets' => array(),
                'events' => array(
                    /* imageoptimonupload with fields set */
                    'OnFileManagerUpload' => array(
                        'priority' => '0', /* priority of the event -- 0 is highest priority */
                        'group' => 'plugins', /* should generally be set to 'plugins' */
                        'propertySet' => '', /* property set to be used in this pluginEvent */
                    ),
                ),
            ),
        ),
    ),
    /* (optional) will make all element objects static - 'static' field above will be ignored */
    'allStatic' => false,


  
    /* ********************************************* */
    /* Define optional directories to create under assets.
     * Add your own as needed.
     * Set to true to create directory.
     * Set to hasAssets = false to skip.
     * Empty js and/or css files will be created.
     */
    'hasAssets' => false,

    'assetsDirs' => array(
        /* If true, a default (empty) CSS file will be created */
        'css' => false,

        /* If true, a default (empty) JS file will be created */
        'js' => false,

        'images' => true,
        'audio' => true,
        'video' => true,
        'themes' => true,
    ),
    /* minify any JS files */
    'minifyJS' => false,
    /* Create a single JS file from all JS files */
    'createJSMinAll' => false,
    /* if this is false, regular jsmin will be used.
       JSMinPlus is slower but more reliable */
    'useJSMinPlus' => false,

    /* These will automatically go under assets/components/yourcomponent/js/
       Format: directory:filename
       (no trailing slash on directory)
       if 'createCmpFiles is true, these will be ignored.
    */
    'jsFiles' => array(),

    /* Desired CSS files */
    'cssFiles' => array(),

    /* ********************************************* */
    /* Define basic directories and files to be created in project*/

    'docs' => array(
        'readme.txt',
        'license.txt',
        'changelog.txt',
        'tutorial.html'
    ),

    /* (optional) Description file for GitHub project home page */
    'readme.md' => true,
    /* assume every package has a core directory */
    'hasCore' => false,
    
    
    /* ********************************************* */
    /* (optional) Array of extra script resolver(s) to be run
     * during install. Note that resolvers to connect plugins to events,
     * property sets to elements, resources to templates, and TVs to
     * templates will be created automatically -- *don't* list those here!
     *
     * 'default' creates a default resolver named after the package.
     * (other resolvers may be created above for TVs and plugins).
     * Suffix 'resolver.php' will be added automatically */
    'resolvers' => array(
        'default'
    ),



    /* (optional) install.options is needed if you will interact
     * with user during the install.
     * See the user.input.php file for more information.
     * Set this to 'install.options' or ''
     * The file will be created as _build/install.options/user.input.php
     * Don't change the filename or directory name. */
    'install.options' => 'install.options',


    /* Suffixes to use for resource and element code files (not implemented)  */
    'suffixes' => array(
        'modPlugin' => '.php',
        'modSnippet' => '.php',
        'modChunk' => '.html',
        'modTemplate' => '.html',
        'modResource' => '.html',
    ),


 

    /* ************************************
     *  These values are for CMPs.
     *  Set any of these to an empty array if you don't need them.
     *  **********************************/

    /* If this is false, the rest of this section will be ignored */

    'createCmpFiles' => false,

    /* IMPORTANT: The array values in the rest of
       this section should be all lowercase */

    /* This is the main action file for your component.
       It will automatically go in core/component/yourcomponent/
    */

    'actionFile' => 'index.class.php',

    /* CSS file for CMP */

    'cssFile' => 'mgr.css',

    /* These will automatically go to core/components/yourcomponent/processors/
       format directory:filename
       '.class.php' will be appended to the filename

       Built-in processor classes include getlist, create, update, duplicate,
       import, and export. */

    'processors' => array(
        'mgr/snippet:getlist',
        'mgr/snippet:changecategory',
        'mgr/snippet:remove',

        'mgr/chunk:getlist',
        'mgr/chunk:changecategory',
        'mgr/chunk:remove',
    ),

    /* These will automatically go to core/components/yourcomponent/controllers[/directory]/filename
       Format: directory:filename */

    'controllers' => array(
        ':home.class.php',
    ),

    /* These will automatically go in assets/components/yourcomponent/ */

    'connectors' => array(
        'connector.php'

    ),
    /* These will automatically go to assets/components/yourcomponent/js[/directory]/filename
       Format: directory:filename */

    'cmpJsFiles' => array(
        ':imageoptimonupload.class.js',
        'sections:home.js',
        'widgets:home.panel.js',
        'widgets:snippet.grid.js',
        'widgets:chunk.grid.js',
    ),

    /* These go to core/components/componentName/templates/
     * The format is:
     *    filename:content
     * content is optional
     */

    'cmpTemplates' => array (
         'mgr:<div id="imageoptimonupload-panel-home-div"></div>',
    ),


    /* *******************************************
     * These settings control exportObjects.php  *
     ******************************************* */
    /* ExportObjects will update existing files. If you set dryRun
       to '1', ExportObjects will report what it would have done
       without changing anything. Note: On some platforms,
       dryRun is *very* slow  */

    'dryRun' => '0',

    /* Array of elements to export. All elements set below will be handled.
     *
     * To export resources, be sure to list pagetitles and/or IDs of parents
     * of desired resources
    */
    'process' => array(
        'contexts',
        'snippets',
        'plugins',
        'templateVars',
        'templates',
        'chunks',
        'resources',
        'propertySets',
        'systemSettings',
        'contextSettings',
        'systemEvents',
        'menus'
    ),
    /*  Array  of resources to process. You can specify specific resources
        or parent (container) resources, or both.

        They can be specified by pagetitle or ID, but you must use the same method
        for all settings and specify it here. Important: use IDs if you have
        duplicate pagetitles */
    'getResourcesById' => false,

    /* Array of resource parent IDs to get children of. */
    'parents' => array(),
    /* Also export the listed parent resources
      (set to false to include just the children) */
    'includeParents' => false,


    /* ******************** LEXICON HELPER SETTINGS ***************** */
    /* These settings are used by LexiconHelper */
    'rewriteCodeFiles' => true,  /* remove ~~descriptions */
    'rewriteLexiconFiles' => true, /* automatically add missing strings to lexicon files */
    /* ******************************************* */

    /* Array of aliases used in code for the properties array.
     * Used by the checkproperties utility to check properties in code against
     * the properties in your properties transport files.
     * if you use something else, add it here (OK to remove ones you never use.
     * Search also checks with '$this->' prefix -- no need to add it here. */
    'scriptPropertiesAliases' => array(
        'props',
        'sp',
        'config',
        'scriptProperties'
    ),
);

return $components;