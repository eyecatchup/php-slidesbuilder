<?php
namespace Libname;

use PHPUnit_Framework_TestCase as TestCase;
use PHPUnit_Framework_Constraint_IsEqual as IsEqual;
use Libname\Model\DemoModel;

/**
 *	Test case for DemoClass.
 *	This test is just plain stupid.
 */
class DemoClassTest extends TestCase
{

	/**
	 *
	 */
	public $DemoClass = null;

	/**
	 *
	 */
	public function isEqual($value) {
		return new IsEqual($value);
	}

	/**
	 *
	 */
	public function testModel() {
		$DemoClass = new DemoClass('foo', 'bar');

		$Model = $DemoClass->getModel();

		$this->assertInstanceOf('\\Libname\\Model\\DemoModel', $Model);
		$this->assertEquals('foo bar', $DemoClass->loadOutput());
	}
}
