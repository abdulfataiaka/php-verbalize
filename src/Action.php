<?php

namespace Leickon\Verbalize;

use BadMethodCallException;
use Leickon\Verbalize\Concern;
use Leickon\Verbalize\FailureException;

class Action
{
  use Concern;

  /**
   * Array of action inputs
   * 
   * @property array[field|field=>default]
   */
  protected const INPUT = [];

  /**
   * Disallow instantiation of actions
   * 
   * @method
   */
  private function __construct() {}

  /**
   * Define desired parameters
   * 
   * @api
   * @return void
   */
  protected function init() {}

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
