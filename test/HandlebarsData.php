<?php
namespace Cradle\Handlebars;

use PHPUnit\Framework\TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-27 at 02:11:00.
 */
class Cradle_Handlebars_HandlebarsData_Test extends TestCase
{
  /**
   * @var HandlebarsData
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new HandlebarsData([
      'product_id' => 123,
      'product_title' => 'Hello World',
      'product_comments' => [
        'comment1' => 'this is good',
        'comment2' => 'this is great',
        'comment3' => 'this is nice'
      ]
    ]);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsData::__construct
   */
  public function test__construct()
  {
    $actual = $this->object->__construct([
      'product_id' => 123,
      'product_title' => 'Hello World',
      'product_comments' => [
        'comment1' => 'this is good',
        'comment2' => 'this is great',
        'comment3' => 'this is nice'
      ]
    ]);

    $this->assertNull($actual);
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsData::find
   */
  public function testFind()
  {
    $this->assertEquals(123, $this->object->find('product_id'));
    $this->assertEquals('Hello World', $this->object->find('product_title'));
    $this->assertEquals('this is good', $this->object->find('product_comments.comment1'));
    $this->assertEquals('this is great', $this->object->find('product_comments.comment2'));
    $this->assertEquals('this is nice', $this->object->find('product_comments.comment3'));
    $this->assertNull($this->object->find('product_id', 40));
    $this->assertEquals(123, $this->object->find('./product_id'));
    $this->assertEquals(3, $this->object->find('product_comments.length'));
    $this->assertEquals(11, $this->object->find('product_title.length'));
    $this->assertEquals(0, $this->object->find('product_id.length'));
    $this->assertNull($this->object->find('foobar.zoo'));
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsData::get
   */
  public function testGet()
  {
    $data = $this->object->get();
    $this->assertTrue(is_array($data));
    $this->assertEquals(123, $data['product_id']);
    $this->assertEquals('Hello World', $data['product_title']);
    $this->assertEquals('this is good', $data['product_comments']['comment1']);
    $this->assertEquals('this is great', $data['product_comments']['comment2']);
    $this->assertEquals('this is nice', $data['product_comments']['comment3']);
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsData::push
   * @covers Cradle\Handlebars\HandlebarsData::find
   */
  public function testPush()
  {
    $instance = $this->object
      ->push(array(
        'comment1' => 'this is good',
        'comment2' => 'this is great',
        'comment3' => 'this is nice'
      ))
      ->push(array(
        'comment4' => 'this is cool',
        'comment5' => 'this is awesome',
        'comment6' => 'this is epic'
      ));

    $this->assertInstanceOf('Cradle\Handlebars\HandlebarsData', $instance);

    $this->assertEquals('Hello World', $this->object->find('../../product_title'));
    $this->assertEquals('this is good', $this->object->find('../comment1'));
    $this->assertEquals('this is great', $this->object->find('../../product_comments.comment2'));
    $this->assertEquals('this is epic', $this->object->find('comment6'));

    $this->assertEquals('Hello World', $this->object->find('.././../product_title'));
    $this->assertEquals('this is good', $this->object->find('./../comment1'));
    $this->assertEquals('this is great', $this->object->find('../.././product_comments.comment2'));
    $this->assertEquals('this is epic', $this->object->find('./comment6'));
  }

  /**
   * @covers Cradle\Handlebars\HandlebarsData::pop
   */
  public function testPop()
  {
    $instance = $this->object
      ->push(array(
        'comment1' => 'this is good',
        'comment2' => 'this is great',
        'comment3' => 'this is nice'
      ))
      ->push(array(
        'comment4' => 'this is cool',
        'comment5' => 'this is awesome',
        'comment6' => 'this is epic'
      ))
      ->pop();

    $this->assertInstanceOf('Cradle\Handlebars\HandlebarsData', $instance);

    $this->assertEquals('Hello World', $this->object->find('../product_title'));
    $this->assertEquals('this is good', $this->object->find('comment1'));
    $this->assertEquals('this is great', $this->object->find('../product_comments.comment2'));

    $this->assertEquals('Hello World', $this->object->find('./../product_title'));
    $this->assertEquals('this is good', $this->object->find('./comment1'));
    $this->assertEquals('this is great', $this->object->find('.././product_comments.comment2'));
  }
}
