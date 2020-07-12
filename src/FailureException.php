<?php

namespace Leickon\Verbalize;

use Exception;

class FailureException extends Exception {
  /**
   * Value to hold error message
   * 
   * @property array[[boolean,any]]
   */
  public $value;

  /**
   * Bind value to error object
   * 
   * @method
   */
  public function __construct($value) {
    parent::__construct('Should not be called outside : .define');
    $this->value = $value;
  }
}
