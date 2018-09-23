# Environ [![Build Status](https://img.shields.io/travis/melbahja/environ/master.svg)](https://travis-ci.org/melbahja/environ)
PHP environment loader with the power of the ini syntax and array support

![](environ.jpg?raw=true) <sub>*Premium license: Subscription: I-GXFFSY4T\*\*\*\*\*\**</sub>

## Installation :

```bash
composer require melbahja/environ 1.0.0
```

## NOTE:

Environ has no effect to the php runtime ini configuration, environ only takes env variables form ini file and load them 

## Usage :

Path/to/Your/Project/.env
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
Environ::load('Path/to/Your/Project');

var_dump(Environ::get('APP_MODE')); // string

var_dump(Environ::get('DATABASE')); // array

```

## Environ methods :

```
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