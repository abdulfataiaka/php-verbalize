# PHP Verbalize

Making classes into actions by creating a PHP flavour of [verbalize](https://github.com/taylorzr/verbalize), which is an attempt to implement the interactor design pattern.

#### Installation

```bash

$ composer require leickon/php-verbalize

```

#### Define Action Class

```php

use Leickon\Verbalize\Action;

class ExampleAction extends Action {
  protected const INPUT = [
    'name',
    'age' => 20,
  ];

  protected function init() {
    $this->data = [$this->age];
  }

  protected function define() {
    if ($this->data[0] < 10) {
      $this->fail('Age is less than 10');
    }

    return [$this->name, $this->age];
  }
}

```

#### Execute : No Parameters

```php

ExampleAction::call(); // throws name required exception

```

#### Execute : Name Provided

```php

$result = ExampleAction::call(['name' => 'John']);
$result->success; // true
$result->failure; // false
$result->value; // ['John', 20]

```

#### Execute : Name & Age Provided

```php

$result = ExampleAction::call([
  'name' => 'John', 'age' => 60
]);

$result->value; // ['John', 60]

```

#### Execute : Failing Action

```php

$result = ExampleAction::call([
  'name' => 'John',
  'age' => 2
]);

$result->success; // false
$result->failure; // true
$result->value; // 'Age is less than 10'

```

## Running Tests

```bash

$ ./phpunit

```

## License

[MIT](https://choosealicense.com/licenses/mit/)

## Contributors

[Abdulfatai Aka](mailto:abdulfataiaka@gmail.com) - [Ascent Technologies](https://www.ascentregtech.com/)
