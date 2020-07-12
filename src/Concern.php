<?php

namespace Leickon\Action;

use StdClass;
use Exception;
use Leickon\Action\FailureException;

class BadInputException extends Exception {}
class InputRequiredException extends Exception {}

trait Concern {
  /**
   * Parse and bind attributes to object
   * 
   * @param input<array>
   * @internal
   * @return void
   * @throws BadInputException
   * @throws InputRequiredException
   */
  private function marshal($input)
  {
    foreach(static::INPUT as $name => $default) {
      $required = false;

      if(is_int($name)) {
        $name = $default;
        $required = true;
      }

      if(
        !is_string($name) ||
        !preg_match('/^[A-Za-z]+?\d*?$/', $name)
      ) throw new BadInputException($name);

      if(
        $required &&
        !array_key_exists($name, $input)
      ) throw new InputRequiredException($name);

      $this->$name = array_key_exists($name, $input)
        ? $input[$name]
        : $default;
    }
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
    $instance->marshal($input);
    $instance->init();

    $result = new StdClass();

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
