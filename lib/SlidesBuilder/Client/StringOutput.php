<?php
namespace SlidesBuilder\Client;

use SlidesBuilder\Interfaces\OutputInterface;

class StringOutput implements OutputInterface
{
    public function load($data)
    {
        return $data;
    }
}
