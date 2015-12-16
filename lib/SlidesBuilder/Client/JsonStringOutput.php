<?php
namespace SlidesBuilder\Client;

use SlidesBuilder\Interfaces\OutputInterface;

class JsonStringOutput implements OutputInterface
{
    public function load($data)
    {
        return json_encode($data);
    }
}
