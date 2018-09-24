# Environ [![Build Status](https://img.shields.io/travis/melbahja/environ/master.svg)](https://travis-ci.org/melbahja/environ) ![PHP from Travis config](https://img.shields.io/travis/php-v/melbahja/environ.svg) [![Twitter](https://img.shields.io/twitter/url/https/github.com/melbahja/environ.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Fmelbahja%2Fenviron)

PHP environment loader with the power of the ini syntax and array support

![](environ.jpg?raw=true)

## Installation :

```bash
composer require melbahja/environ 1.0.0
```

## NOTE:

Environ has no effect to the php runtime ini configuration, environ only takes env variables form ini file and load them 

## Usage :

path/to/your/project/.env
```ini

; set a var
APP_MODE = "dev"

; array
[DATABASE]
HOST = '127.0.0.1'
USERNAME = 'root'
PASSWORD = null

```

YourScript.php
```php

require 'vendor/autoload.php';

use Melbahja\Environ\Environ;

// environ looking for .env or env.ini file in your directory
Environ::load('path/to/your/project');

var_dump(Environ::get('APP_MODE')); // string

var_dump(Environ::get('DATABASE')); // array

```

## Helper

```php
  # if you want a helper
  function env(string $var, $default = null)
  {
    return \Melbahja\Environ\Environ::get($var, $default);
  }
```

## Environ methods :

```php
Environ::load(string $directory): bool
```
```
Environ::get(string $var, $default = null): mixed
```
```
Environ::set(string $var, $value): bool
```
```
# Example: Environ::is('apache') 
Environ::is(string $sapi): bool
```


## License :

[MIT](https://github.com/melbahja/environ/blob/master/LICENSE) Copyright (c) 2018 Mohamed Elbahja
