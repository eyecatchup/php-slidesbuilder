<?php
namespace SlidesBuilder\DI\Container;

use SlidesBuilder\Wizard;
use SlidesBuilder\DI\Container;
use SlidesBuilder\Model\HTMLDocumentModel;

class Standard extends Container
{
    /**
     *  Sets the default properties.
     *
     *  @param array $properties Dependency injection settings.
     */
    public function __construct(array $properties = [])
    {
        $this->setupDefaults();
        $this->setupBasePaths();
        $this->setupPathsConfig();

        $this->configure($properties);

        $this->setupDocumentDomainModel();
        $this->setupMdConverter();
    }

    /**
     *  Set defaults for configurable properties.
     */
    protected function setupDefaults()
    {
        $this->configure([
            // relative to the package root
            '_buildAppDir' => 'app',
            // relative to the _buildAppDir
            '_markdownDir' => 'markdown-slides',
            // relative to the _buildAppDir
            '_templateDir' => 'assets/templates',
            // relative to the _templateDir
            '_baseTemplate' => 'base.html',
            // the string to be replaced with the generated html
            '_replaceMarker' => '<!--###CONTENT_SLIDES###-->',
            // will be saved in the package root
            '_saveAs' => 'auto-generated.html',
            // maps special class names to specific templates
            '_pageTemplates' => [
                'default' => 'page-default.html',
                'new-chapter' => 'page-chapter-cover.html',
                'iframe' => 'page-iframe.html'
            ]
        ]);
    }

    /**
     *  Set application base path names.
     */
    protected function setupBasePaths()
    {
        if (!realpath(__DIR__ . '/../../../../vendor/')) {
            throw new \Exception('no vendor dir?! forgot `composer install`?');
            exit(66);
        }

        $this->configure([
            'packageRoot' => realpath(__DIR__ . '/../../../../'),
            'appRoot' => realpath(__DIR__ . '/../../../../'
                . $this->get('_buildAppDir') . '/')
        ]);
    }

    /**
     *  Set-up main configuration.
     */
    protected function setupPathsConfig()
    {
        $appRoot = $this->get('appRoot');

        $this->configure([
            'pathsConfig' => [
                'appRoot' => $appRoot,
                'packageRoot' => $this->get('packageRoot'),
                'markdownRoot' => realpath(
                    $appRoot . '/' . $this->get('_markdownDir')
                ),
                'templateRoot' => realpath(
                    $appRoot . '/' . $this->get('_templateDir')
                ),
                'compileCacheRoot' => $this->get('packageRoot')
                    . DIRECTORY_SEPARATOR . 'compile_cache'
            ]
        ]);
    }

    /**
     *  Set-up main configuration.
     */
    protected function setupDocumentDomainModel()
    {
        $paths = $this->get('pathsConfig');

        $this->configure([
            'documentDefaults' => [
                'appRoot' => $paths['appRoot'],
                'packageRoot' => $paths['packageRoot'],
                'markdownRoot' => $paths['markdownRoot'],
                'templateRoot' => $paths['templateRoot'],
                'template' => [
                    'baseTemplateFilename' => $this->get('_baseTemplate'),
                    'baseTemplateMarker' => $this->get('_replaceMarker'),
                    //'baseTemplateHTML' => $html,
                    'pageTemplates' => $this->get('_pageTemplates'),
                ],
                'saveAs' => $this->get('_saveAs')
            ],
            'document' => Container::unique(function($C) {
                return new HTMLDocumentModel($C->get('documentDefaults'));
            })
        ]);
    }
	
    /**
     * Get all Markdown files (.md, .markdown) within the {@$this->markdownRoot}
     * directory and return a list of found filenames as array.
     */
    protected function setupMdConverter()
    {
		$paths = $this->get('pathsConfig');
		$mdRoot = $paths['markdownRoot'];
		
		$mdFiles = glob($mdRoot . DIRECTORY_SEPARATOR . "*.{md,markdown}", 
			GLOB_BRACE | GLOB_NOSORT);
        $mdFiles = (is_array($mdFiles) && 0 < sizeof($mdFiles)) ? $mdFiles : [];
		
        $this->configure([
            'mdFilesList' => $mdFiles
        ]);
    }
}
