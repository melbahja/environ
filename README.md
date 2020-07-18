# Environ [![Build Status](https://img.shields.io/travis/melbahja/environ/master.svg)](https://travis-ci.org/melbahja/environ) ![PHP from Travis config](https://img.shields.io/travis/php-v/melbahja/environ.svg) [![Twitter](https://img.shields.io/twitter/url/https/github.com/melbahja/environ.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=https%3A%2F%2Fgithub.com%2Fmelbahja%2Fenviron)

Load PHP environment variables from .env (INI syntax) file only on `$_ENV` and runtime.

![](environ.jpg?raw=true)

## Installation :

```bash
composer require melbahja/environ
```

## Why?

Some env libraries load variables into `$_SERVER` and `$_REQUEST`, which is a stupid idea that can lead to expose credentials and insert sensitive information into log files. `environ` only load variables to superglobal `$_ENV` and runtime via `putenv`.


## Usage :

`/path/to/your/project/.env`

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
Environ::load('/path/to/your/project');

var_dump(Environ::get('APP_MODE')); // string

var_dump(Environ::get('DATABASE')); // array

var_dump($_ENV['DATABASE']); // array

```

### Note:
Arrays will not be available in `getenv()`, you can only access them via `$_ENV` or `Environ::get()`.

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
```php
Environ::get(string $var, $default = null): mixed
```
```php
Environ::set(string $var, $value): bool
```
```php
# Example: Environ::is('apache'), Environ::is('cli')
Environ::is(string $sapi): bool
```


## License :

[MIT](https://github.com/melbahja/environ/blob/master/LICENSE) Copyright (c) 2018-present Mohamed Elbahja
