<?php

namespace Leickon\Verbalize\Tests\Factory;

use Exception;
use Leickon\Verbalize\Action;

class EmptyAction extends Action
{
  public static function create() {
    try {
      return static::call();
    } catch(Exception $exc) {
      return $exc;
    }
  }
}
