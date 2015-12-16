<?php
namespace SlidesBuilder;

use SlidesBuilder\DI\Container;
use SlidesBuilder\DI\Container\Standard as StandardContainer;
use SlidesBuilder\Interfaces\OutputInterface;
use SlidesBuilder\Helper\MarkdownParser;
use Twig_Environment;

class Wizard
{
    /**
     *  HTML document domain model representation.
     *
     *  @var SlidesBuilder\Model\HTMLDocumentModel
     */
    private $document;

    /**
     *  Any valid output interface implementation.
     *
     *  @var SlidesBuilder\Client\StringOutput |
     *       SlidesBuilder\Client\JsonStringOutput
     */
    private $output;

    /**
     *  Dependency-Injection container.
     *
     *  @var SlidesBuilder\DI\Container
     */
    protected $container = null;

    /**
     *  Twig template engine instance
     *
     *  @var Twig\Twig_Environment
     */
    protected $twig = null;

    /**
     *  Markdown parser instance
     *
     *  @var Helper\MarkdownParser
     */
    protected $parser = null;

    /**
     *  Constructor.
     *
     *  @param array $config Dependency-Injection configuration
     *  @void
     */
    public function __construct(array $config = [])
    {
        $this->container = new StandardContainer($config);
        $this->document = $this->container->get('document');
    }

    /**
     *  Convert md files to HTML document (as configured).
     *
     *  @param array $config Dependency-Injection configuration
     *  @void
     */
    public function createDocument(array $config = [])
    {
        if (0 < sizeof($config)) {
            $this->container->configure($config);

            $this->setDocumentModel(Factory\HTMLDocumentFactory::create(
                $this->container->get('documentDefaults')
            ));
            $this->container->set('document', $this->document);
        }

        $this->setTwigEnvorinment(Factory\TwigFactory::create(
            $this->container->get('pathsConfig')
        ));

		$this->parser = new MarkdownParser($this->container());

        $this->setOutput(new Client\StringOutput);
    }

    /**
     *  Get the string representation of the HTML document in buffer.
     *
     *  @return string String-representation of the composed HTML-Document
     *  @throws \Exception
     */
    public function getComposedDocument()
    {
        if ($this->document == null) {
            throw new \Exception('Nothing done yet! Use createDocument first.');
            exit(64);
        }
		
        return $this->output->load(
            $this->document->getComposedString($this->parser->getSlidesHTML())
        );
    }

    /**
     *  Write the HTML document in buffer to a file.
     *
     *  @return bool
     */
    public function writeCompiledHtmlToFile()
    {
        $html = (string) $this->getComposedDocument();
		$doc = $this->container->get('documentDefaults');
        
		return !file_put_contents( 
			$this->container->get('packageRoot') . DIRECTORY_SEPARATOR . 
				$doc['saveAs'], 
			$this->getComposedDocument()) 
				? false : true;
    }

    /**
     *  Get the domain model representation of the HTML document in buffer.
     *
     *  @return SlidesBuilder\Model\HTMLDocumentModel The domain model
     */
    public function getDocumentModel()
    {
        return $this->document;
    }

    /**
     *  Return the current Twig template-engine instance.
     *
     *  @return Twig\Twig_Environment An instance of Twig_Environment
     */
    public function getTwigInstance()
    {
        return $this->twig;
    }

    /**
     *  Return the internal DI-container.
     *
     *  @return SlidesBuilder\DI\Container DI-container
     */
    public function container()
    {
        return $this->container;
    }

    /**
     *  Set the output format for the HTML document in buffer.
     *
     *  @param SlidesBuilder\Interfaces\OutputInterface $outputType Interface
     *  @void
     */
    public function setOutput(OutputInterface $outputType)
    {
        $this->output = $outputType;
    }

    /**
     *  (Re-)Set the domain model instance.
     *
     *  @param SlidesBuilder\Model\HTMLDocumentModel $model The domain model
     *  @void
     */
    private function setDocumentModel(Model\HTMLDocumentModel $model)
    {
        $this->document = $model;
    }

    /**
     *  Create a new template engine instance when the build config was updated.
     *
     *  @param Twig\Twig_Environment $env Template-engine instance
     *  @void
     */
    private function setTwigEnvorinment(Twig_Environment $env)
    {
        $this->twig = $env;
        $this->container->set('twig', $this->twig);
    }
}
