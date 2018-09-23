<?php
namespace Melbahja\Environ;

use Melbahja\Environ\Interfaces\EnvironInterface;

class Environ implements EnvironInterface
{

	/**
	 * Load env file from directory
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
	 * Get form env
	 * @param  string $k
	 * @param  mixed $default
	 * @return mixed
	 */
	public static function get(string $k, $default = null)
	{
		$val = $_ENV[$k] ?? getenv($k);

		if ($val === false) {

			return $default;
		}

		return $val;
	}

	/**
	 * Set env value 
	 * @param string $k
	 * @param mixed $v
	 * @return bool
	 */
	public static function set(string $k, $v): bool
	{
		if (is_array($v)) {
			
			$_ENV[$k] = $v;
			return true;
		}

		return putenv("{$k}={$v}");
	}

	/**
	 * Check server api type
	 * ex: apache, cli, cgi
	 * @param  string  $sapi
	 * @return bool
	 */
	public static function is(string $sapi): bool
	{
		return (substr(PHP_SAPI, 0, strlen($sapi)) === $sapi);
	}
}
