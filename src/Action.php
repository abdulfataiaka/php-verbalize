<?php

namespace Leickon\Action;

use BadMethodCallException;
use Leickon\Action\Concern;
use Leickon\Action\FailureException;

class Action {
  use Concern;

  /**
   * Array of parameters
   * 
   * @property array[[boolean,any]]
   */
  private $params;

  /**
   * Initialize the parameters array
   * 
   * @method
   */
  private function __construct() {
    $this->params = [];
  }

  /**
   * Define desired parameters
   * 
   * @api
   * @return void
   */
  protected function init() {
    //=! Do nothing when not defined
  }

  /**
   * Procedure to execute
   * 
   * @api
   * @return any
   * @throws BadMethodCallException
   */
  protected function define() {
    throw new BadMethodCallException();
  }

  /**
   * End action procedure with value
   * 
   * @api
   * @throws FailureException
   */
  protected function fail($value) {
    throw new FailureException($value);
  }
}
