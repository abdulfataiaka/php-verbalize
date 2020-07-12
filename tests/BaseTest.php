<?php

namespace Leickon\Action\Tests;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Leickon\Action\InputRequiredException;
use Leickon\Action\Tests\Factory\TestAction;
use Leickon\Action\Tests\Factory\EmptyAction;

class BaseTest extends TestCase
{
  public function testRequired()
  {
    $result = TestAction::create();

    $this->assertInstanceOf(InputRequiredException::class, $result);
    $this->assertSame($result->getMessage(), 'name');
  }

  public function testDefault()
  {
    $result = TestAction::create('John');

    $this->assertSame($result->success, true);
    $this->assertSame($result->failure, false);
    $this->assertSame($result->value, ['John', 'male']);
  }

  public function testDefaultChange()
  {
    $result = TestAction::create('John', 'female');

    $this->assertSame($result->success, true);
    $this->assertSame($result->failure, false);
    $this->assertSame($result->value, ['John', 'female']);
  }

  public function testFail()
  {
    $result = TestAction::create('John', 'unknown');
    
    $this->assertSame($result->success, false);
    $this->assertSame($result->failure, true);
    $this->assertSame($result->error, TestAction::FAIL);
  }

  public function testNoDefineMethod()
  {
    $result = EmptyAction::create();

    $this->assertInstanceOf(BadMethodCallException::class, $result);
  }
}
