<?php

namespace Leickon\Action;

use BadMethodCallException;

class Action {
  use \Leickon\Action\Concern;

  private $params;

  private function __construct() {
    $this->params = [];
  }

  protected function define() {
    throw new BadMethodCallException();
  }
}
