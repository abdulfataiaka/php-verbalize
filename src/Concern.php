<?php

namespace Leickon\Action;

use StdClass;
use Leickon\Action\Failure;

trait Concern {
  protected function require(string $param) {
    $this->param($param);
  }

  protected function optional(string $param, $default = null) {
    $this->param($param, $default, true);
  }

  protected function fail($value) {
    throw new Failure($value);
  }

  private function param($name, $default = null, $optional = false) {
    $param = new StdClass();
    $param->name = $name;
    $param->value = null;
    $param->default = $default;
    $param->optional = $optional;
    $this->params[$name] = $param;
  }

  protected function init() {
    //=! Do nothing if not defined
  }

  protected function setup() {
    
  }

  public static function call(array $params) {
    $instance = new static();
    $result = new StdClass();
    $instance->init();
    $instance->setup();

    try {
      $result->success = true;
      $result->value = $instance->define();
    } catch(Failure $exc) {
      $result->success = false;
      $result->error = $exc->value;
    }

    return $result;
  }
}
