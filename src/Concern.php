<?php

namespace Leickon\Action;

use StdClass;
use Leickon\Action\RequiredException;
use Leickon\Action\BadInputArgsException;

trait Concern {
  /**
   * Define a expected inputs
   * 
   * @param array[string,any?] $args
   * 
   * @api
   * @return void
   */
  protected function input(...$args) {
    if(
      !in_array(count($args), [1, 2]) ||
      !is_string($args[0]) ||
      !strlen(trim($args[0]))
    ) throw new BadInputArgsException();

    $name = trim($args[0]);
    $require = count($args) === 1;
    $default = count($args) === 1 ? null : $args[1];

    $this->params[$name] = [$require, $default];
  }

  /**
   * Bind attributes to action object
   * 
   * @param array $input Values to be used by procedure
   * 
   * @internal
   * @return void
   * @throws RequiredException
   */
  private function setup(array $input) {
    foreach($this->params as $name => [$require, $default]) {
      $exists = array_key_exists($name, $input);

      if(!$exists && $require) {
        throw new RequiredException(
          "Action input { $name } is required"
        );
      }

      $this->$name = !$exists ? $default : $input[$name];
    }
  }

  /**
   * Start the action procedure
   * 
   * @param array $input Values to be used by procedure
   * 
   * @api
   * @return StdClass
   */
  public static function call(array $input = []) {
    $instance = new static();
    $result = new StdClass();
    $instance->init();
    $instance->setup($input);

    try {
      $result->success = true;
      $result->value = $instance->define();
    } catch(Failure $exc) {
      $result->success = false;
      $result->error = $exc->value;
    }

    $result->failure = !$result->success;
    return $result;
  }
}
