# Action

Making classes into actions

### Installation

```bash

# Ensure composer can access repository

$ composer require leickon/php-action

```

### Define Action Class

```php

use Leickon\Action\Action;

class ExampleAction extends Action {
  protected function init() {
    $this->input('name');
    $this->input('age', 20);
  }

  protected function define() {
    if ($this->age < 10) {
      $this->fail('Age is less than 10');
    }

    return [$this->name, $this->age];
  }
}

```

### Execute : No Parameters

```php

// Throws : name required exception
// Age is optional since it has a default value

ExampleAction::call();

```

### Execute : Age Optional

```php

$result = ExampleAction::call(['name' => 'John']);
$result->success; // true
$result->failure; // false
$result->value; // ['John', 20]

```

### Execute : Age Not Optional

```php
$result = ExampleAction::call(['name' => 'John', 'age' => 60]);
$result->value; // ['John', 60]

```

### Execute : Failing Action

```php

$result = ExampleAction::call(['name' => 'John', 'age' => 2]);
$result->success; // false
$result->failure; // true
$result->value; // 'Age is less than 10'

```

### Authors

Abdulfatai Aka - <abdulfataiaka@gmail.com> | Software engineer at [Ascent Technologies](https://www.ascentregtech.com/)
