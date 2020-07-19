<?php
namespace Melbahja\Environ;

use Melbahja\Environ\Interfaces\EnvironInterface;

class Environ implements EnvironInterface
{

	/**
	 * Load env file from a directory.
	 *
	 * @param  string $dir
	 * @return bool
	 */
	public static function load(string $dir): bool
	{
		foreach (['.env', 'env.ini'] as $env)
		{
			$env = $dir . DIRECTORY_SEPARATOR . $env;

			if (file_exists($env)) {

				foreach (parse_ini_file($env, true) as $k => $v)
				{
					static::set($k, $v);
				}

				return true;
			}
		}

		return false;
	}

	/**
	 * Get env variable value.
	 *
	 * @param  string $k
	 * @param  mixed $default
	 * @return mixed
	 */
	public static function get(string $k, $default = null)
	{
		if (isset($_ENV[$k])) {
			return $_ENV[$k];
		}

		return getenv($k) ?: $default;
	}

	/**
	 * Set env variable value.
	 *
	 * @param string $k
	 * @param mixed $v
	 * @return bool
	 */
	public static function set(string $k, $v): bool
	{
		$_ENV[$k] = $v;
		return is_string($_ENV[$k]) ? putenv("{$k}={$v}") : true;
	}

	/**
	 * Check server api type (example: apache, cli, cgi).
	 *
	 * @param  string  $sapi
	 * @return bool
	 */
	public static function is(string $sapi): bool
	{
		return (substr(PHP_SAPI, 0, strlen($sapi)) === $sapi);
	}
}
