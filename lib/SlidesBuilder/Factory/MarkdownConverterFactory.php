<?php
namespace SlidesBuilder\Factory;

use SlidesBuilder\Model\HTMLDocumentModel;

class HTMLDocumentFactory
{
    public static function create(array $properties)
    {
        return new HTMLDocumentModel($properties);
    }
}
