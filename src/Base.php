<?php

namespace Leickon\Action;

use BadMethodCallException;
use Leickon\Action\Concern;
use Leickon\Action\FailureException;

class Base
{
  use Concern;

  /**
   * Context attribute initializer
   * 
   * @property StdClass
   */
  protected $context;

  /**
   * Array of action inputs
   * 
   * @property array[field|field=>default]
   */
  protected const INPUT = [];

  /**
   * Disallow instantiation of actions
   * Initialize context object
   * 
   * @method
   */
  private function __construct()
  {
    $this->context = new StdClass();
  }

  /**
   * Define desired parameters
   * 
   * @api
   * @return void
   */
  protected function initialize() {
    // Do nothing when not defined
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
