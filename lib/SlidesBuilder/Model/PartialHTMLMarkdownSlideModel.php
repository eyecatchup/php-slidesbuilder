<?php
namespace SlidesBuilder\Model;

class HTMLDocumentModel
{
    /**
	 *	Defaults.
	 *
	 *	@var array
	 */
	protected $defaults = [];

    public function __construct(array $properties)
    {
		$this->defaults = $properties;
    }

    public function getString()
    { 	
		$html = '';
		if ($this->defaults['templateRoot']) {
			$file = $this->defaults['templateRoot'] . DIRECTORY_SEPARATOR .
				$this->defaults['template']['baseTemplateFilename'];
			
			$html = @file_get_contents((string) $file);		
		}
		return (string) $html;
    }

    public function getComposedString($str)
    {
		return (string) str_replace(
			(string) $this->defaults['template']['baseTemplateMarker'],
            (string) $str, 
			(string) $this->getString() 
		);
    }
	
	public function setDefaults(array $properties)
	{
		$this->defaults = $properties;
	}
	
	public function getDefaults()
	{
		return $this->defaults;
	}
}
