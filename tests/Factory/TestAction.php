<?php

namespace Leickon\Verbalize\Tests\Factory;

use Exception;
use Leickon\Verbalize\Action;

class TestAction extends Action {
  const FAIL = 'Gender value is still male';

  protected const INPUT = [
    'name',
    'gender' => 'male'
  ];

  protected function init() {
    $this->data = [
      $this->name,
      $this->gender,
    ];
  }

  protected function define() {
    if($this->gender == 'unknown') {
      $this->fail(self::FAIL);
    }

    return $this->data;
  }

  public static function create($name = null, $gender = null) {
    $params = [];
    if($name) $params['name'] = $name;
    if($gender) $params['gender'] = $gender;

    try {
      return static::call($params);
    } catch(Exception $exc) {
      return $exc;
    }
  }
}
