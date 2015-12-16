<?php
namespace SlidesBuilder\Helper;

use SlidesBuilder\DI\Container;
use SlidesBuilder\DI\Container\Standard as StandardContainer;
use SlidesBuilder\Interfaces\OutputInterface;
use Parsedown as md;
use ParsedownExtra as mdE;
use Twig;

class MarkdownParser
{
    /**
     *  HTML document domain model representation.
     *
     *  @var SlidesBuilder\Model\HTMLDocumentModel
     */
    private $mdFilesList;

    /**
     *  Any valid output interface implementation.
     *
     *  @var SlidesBuilder\Client\StringOutput |
     *       SlidesBuilder\Client\JsonStringOutput
     */
    private $mdSlidesData;

    /**
     *  Any valid output interface implementation.
     *
     *  @var SlidesBuilder\Client\StringOutput |
     *       SlidesBuilder\Client\JsonStringOutput
     */
    private $mdSlidesHtml;

    /**
     *  Dependency-Injection container.
     *
     *  @var SlidesBuilder\DI\Container
     */
    protected $container;

    /**
     *  Any valid output interface implementation.
     *
     *  @var SlidesBuilder\Client\StringOutput |
     *       SlidesBuilder\Client\JsonStringOutput
     */
    private $twig;

    /**
     *  Constructor.
     *
     *  @param array $config Dependency-Injection configuration
     *  @void
     */
    public function __construct($container/*, $twig, array $mdFilesList = []*/)
    {
		$this->container = $container;
		$this->twig = $this->container->get('twig');
        $this->setMdFileList($this->container->get('mdFilesList'));
    }

	public function getMdFileList()
	{
		return $this->mdFilesList;
	}

	public function setMdFileList(array $mdFilesList = [])
	{
		$this->mdFilesList = $mdFilesList;
        $this->setMdSlidesData($this->parseMarkdownData());
		$this->setSlidesHTML($this->getMdSlidesData());
	}

	public function getSlidesHTML()
	{
		return $this->mdSlidesHtml;
	}

	private function setSlidesHTML(array $mdSlidesData)
	{
        $slidesHtml = '';
		
        foreach ((array) $mdSlidesData as $slide) {
			$slideMetaData = $slide['meta'];
			$slideBodyHtml = mdE::instance()->text($slide['content']);
			
            $slideHtml = $this->renderSlide(array(
                'title' => $slideMetaData['title'],
                'content' => $slideBodyHtml,
                'slideType' => $this->hasMeta($slideMetaData, 'page_type'),
                'slideClass' => $this->hasMeta($slideMetaData, 'slide_class'),
                'contentClass' => $this->hasMeta($slideMetaData, 'content_class'),
                'articleClass' => $this->hasMeta($slideMetaData, 'article_class'),
                'titleClass' => $this->hasMeta($slideMetaData, 'title_class'),
                'hgroupClass' => $this->hasMeta($slideMetaData, 'hgroup_class'),
                'footerClass' => $this->hasMeta($slideMetaData, 'footer_class'),
                'listsClass' => $this->hasMeta($slideMetaData, 'lists_class'),
                'backgroundImage' => $this->hasMeta($slideMetaData, 'bg_image'),
                'iframeUrl' => $this->hasMeta($slideMetaData, 'iframe_url'),
                'headerAsideImageBadge' => $this->hasMeta($slideMetaData, 'header_aside_image'),
                'footer' => $this->hasMeta($slideMetaData, 'footer'),
            ));

            $slidesHtml .= (string) $slideHtml . PHP_EOL;
        }

        $this->mdSlidesHtml = (string) rtrim($slidesHtml);

        // Now that we have the base AND the converted HTML,
        // we can finally merge the two - to create our final static page.
        //$this->setComposedHTML();
	}

	public function getMdSlidesData()
	{
		return $this->mdSlidesData;
	}

	private function setMdSlidesData(array $mdSlidesData = [])
	{
		$this->mdSlidesData = $mdSlidesData;
	}
	
	private function hasMeta(array $slideMetaData, $key) 
	{
		return (!is_string($key) || '' == $key || !isset($slideMetaData[$key])) 
			? false : $slideMetaData[$key];
	}
	
    private function parseMarkdownData()
    {
        $mdFiles = $this->getMdFileList();
        if (0 == sizeof($mdFiles)) {
            return [];
        }

        $slidesData = array();

        foreach ($mdFiles as $file) {
            $raw = file_get_contents($file);
			$tmp = explode("---" . PHP_EOL, $raw);
			
			$content = isset($tmp[1]) ? $tmp[1] : 0;
			$postMeta = [];

			foreach (explode(PHP_EOL, trim($tmp[0])) as $meta) {
				$meta = explode(': ', $meta);
				if (strlen(trim($meta[0])) > 0 && isset($meta[1])) {
					$postMeta[trim($meta[0])] = trim($meta[1]);
				} 
			}
			
            $slideData = array(
                'file' => (string) $file,
				'meta' => (array) $postMeta,
                'content' => (string) $content,
                'raw' => (string) $raw,
            );

            array_push($slidesData, $slideData);
        }

        return (array) $slidesData;
    }

    private function renderSlide(array $mdSlideData)
    {
		$slideType = $mdSlideData['slideType'] !== false
			? $mdSlideData['slideType'] : 'default';
			
		if ($slideType == 'iframe' && !$mdSlideData['iframeUrl']) {
			return '<!-- skipped iframe-slide due to missing "iframe_url" meta in post slide. -->';
		}
		
		$templateVars = [];
		foreach ($mdSlideData as $key => $value) {
			$templateVars[$key] = $value;
		}
        
		return $this->twig->render(
			$this->getTemplateFileByMetaSlideType($slideType), 
			$templateVars
		);
    }
	
	private function getTemplateFileByMetaSlideType($slideType)
	{
		$map = $this->container->get('_pageTemplates');

		return !isset($map[$slideType]) ? $map['default'] : $map[$slideType];
	}
}
