<?php

namespace Leickon\Action\Tests\Factory;

use Exception;
use Leickon\Action\Base as Action;

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
