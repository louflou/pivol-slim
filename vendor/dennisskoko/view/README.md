# View
Simple view that renders PHP files.

## Installation
To install this you will need [Composer](https://getcomposer.org/).
Once it is installed you simply go to your project directory and execute the following:
```
composer require dennisskoko/view
```

## Usage
Here is an example to use the View class.
```php
<?php

use DS\View;

require 'vendor/autoload.php';

$view = new View(__DIR__ . '/res/views/hello.phtml', ['name' => 'Dennis Skoko']);
echo $view->render();

// Output: Hi, Dennis Skoko!
```

While in `hello.phtml`
```php
<p>Hi, <?= $name ?>!</p>
```

This works fine but we can do it easier with the help of ViewManager.

```php
<?php

use DS\ViewManager;

require 'vendor/autoload.php';

$manager = new ViewManager([
    'directory' => __DIR__ . '/res/views',
    'prefix' => 'phtml' // Change to what you prefer!
]);

echo $manager
    ->make('hello')
    ->with(['name' => 'Dennis Skoko'])
    ->render();
```

You can also set a manager as global for even more easier using.

```php
<?php

use DS\ViewManager;
use DS\View;

require 'vendor/autoload.php';

$manager = new ViewManager([
    'directory' => __DIR__ . '/res/views',
    'prefix' => 'phtml' // Change to what you prefer!
]);

$manager->setAsGlobal();

echo View::make('hello')
    ->with(['name' => 'Dennis Skoko'])
    ->render();
```
