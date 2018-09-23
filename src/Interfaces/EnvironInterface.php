<?php
namespace Melbahja\Environ\Interfaces;


interface EnvironInterface
{

	public static function load(string $dir): bool;

	public static function set(string $key, $value): bool;

	public static function get(string $key, $default = null);

	public static function is(string $sapi): bool;

}
