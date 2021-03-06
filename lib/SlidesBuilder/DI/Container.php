<?php
namespace SlidesBuilder\DI;

use Parkour\Transform;
use \Closure;

/**
 *  A simple dependency injection container inspired by Pimple (https://github.com/fabpot/Pimple).
 */
class Container
{
    /**
     *  Container properties.
     *
     *  @var array
     */
    protected $_properties = [];

    /**
     *  Returns the value of the given property.
     *
     *  @param string $property Property name.
     *  @param mixed $default Default value to be returned in case the property
     *      doesn't exists.
     *  @return mixed The property value, or the result of the closure execution
     *      if property is a closure, or $default.
     */
    public function get($property, $default = null)
    {
        if (!isset($this->_properties[$property])) {
            return $default;
        }

        $value = $this->_properties[$property];

        if ($value instanceof \Closure) {
            $value = $value($this);
        }

        return $value;
    }

    /**
     *  Sets the value of the given property.
     *
     *  @param string $property Property name.
     *  @param mixed $value New value.
     */
    public function set($property, $value)
    {
        $this->_properties[$property] = $value;
        return $this;
    }

    /**
     *  Merges the given properties with the current ones.
     *
     *  @param array $properties Properties to merge.
     */
    public function configure(array $properties)
    {
        if (0 == sizeof($properties)) {
            return $this;
        }
		
        $this->_properties = Transform::merge(
            $this->_properties,
            $properties
        );

        return $this;
    }

    /**
     *  Returns a wrapper that memorizes the result of the given closure.
     *
     *  @param Closure $closure Closure to wrap.
     *  @return Closure Wrapper.
     */
    public static function unique(\Closure $closure)
    {
        return function ($Container) use ($closure) {
            static $result = null;

            if ($result === null) {
                $result = $closure($Container);
            }

            return $result;
        };
    }
}
