<?php //-->
/**
 * This file is part of the Handlebars PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Handlebars;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:00.
 */
class Cradle_Handlebars_HandlebarsException_Test extends TestCase
{
  /**
   * @var HandlebarsException
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new HandlebarsException;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsException::forMissingClosing
   */
  public function testForMissingClosing()
  {
    $actual = null;
    $open = [
      [
        'value' => 'foo',
        'line' => 1
      ],
      [
        'value' => 'bar',
        'line' => 2
      ]
    ];

    try {
      throw HandlebarsException::forMissingClosing($open);
    } catch(HandlebarsException $e) {
      $actual = $e->getMessage();
    }

    $expected = 'Missing closing tags for: "foo" on line 1 AND "bar" on line 2';

    $this->assertEquals($expected, $actual);
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsException::forUnknownEnd
   */
  public function testForUnknownEnd()
  {
    $actual = null;
    try {
      throw HandlebarsException::forUnknownEnd('foo', 12);
    } catch(HandlebarsException $e) {
      $actual = $e->getMessage();
    }

    $expected = 'Unknown close tag: "foo" on line 12';

    $this->assertEquals($expected, $actual);
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsException::forCompileError
   */
  public function testForCompileError()
  {
    $actual = null;
    $code = "Line 1\nLine 2\nLine 3\nLine 4\n";
    $error = [
      'line' => 2,
      'message' => 'foobar'
    ];

    try {
      throw HandlebarsException::forCompileError($error, $code, 1);
    } catch(HandlebarsException $e) {
      $actual = $e->getMessage();
    }

    $expected = "foobar on line 2 \n```\n2: Line 2\n3: Line 3\n```\n";

    $this->assertEquals($expected, $actual);
  }
}
