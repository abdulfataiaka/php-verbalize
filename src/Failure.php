<?php

namespace Leickon\Action;

use Exception;

class Failure extends Exception {
  public $value;

  public function __construct($value) {
    parent::__construct('Should not be called outside : .define');
    $this->value = $value;
  }
}
