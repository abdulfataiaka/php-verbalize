<?php

namespace Leickon\Action;

use StdClass;
use Leickon\Action\FailureException;

class RequiredException extends Exception {}
class BadInputArgsException extends Exception {}

trait Concern {
  /**
   * Parse and bind attributes to object
   * 
   * @internal
   * @return void
   * @throws RequiredException
   */
  private function parseInput()
  {
    // Read static::INPUT and bind attributes to instance
    // Validate attribute name format
    // Consider integer index and string index
  }

  /**
   * Start the action procedure
   * 
   * @param input<array>
   * 
   * @api
   * @return StdClass
   */
  public static function call(array $input = []) {
    $instance = new static();
    $result = new StdClass();
    $instance->parseInput($input);
    $instance->initialize();

    try {
      $result->success = true;
      $result->value = $instance->define();
    } catch(FailureException $exc) {
      $result->success = false;
      $result->error = $exc->value;
    }

    $result->failure = !$result->success;
    return $result;
  }
}
