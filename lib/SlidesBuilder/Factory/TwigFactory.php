<?php
namespace SlidesBuilder\Factory;

use Twig;
use Twig_Environment;
use Twig_Loader_Filesystem;

class TwigFactory
{
    public static function create(array $config)
    {
        $ldr = new Twig_Loader_Filesystem($config['templateRoot']);
        return new Twig_Environment(
            $ldr,
            array('cache' => $config['compileCacheRoot'])
        );
    }
}
