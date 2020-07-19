<?php
namespace Melbahja\Environ\Tests;

use Melbahja\Environ\{
	Environ,
	Interfaces\EnvironInterface
};
use PHPUnit\Framework\TestCase;

class SemverTest extends TestCase
{


	public function testDotEnvLoad()
	{

		$isEnvFound = Environ::load(__DIR__);

		$this->assertTrue($isEnvFound);
	}


	public function testGetFromTheEnv()
	{
		$this->assertSame(Environ::get('APP_MODE'), 'dev');

		$arrayVar = Environ::get('API_NAME');

		$this->assertArrayHasKey('API_KEY', $arrayVar);
		$this->assertSame($arrayVar['API_KEY'], 'appkey');

		$this->assertSame($_ENV['API_NAME']['API_KEY'], 'appkey');

		$this->assertArrayHasKey('svn', Environ::get('urls'));
		$this->assertArrayHasKey('git', Environ::get('urls'));

		$this->assertArrayHasKey('git', $_ENV['urls']);
		$this->assertArrayHasKey('git', $_ENV['urls']);
	}


	public function testNotEnvFoundInDirectory()
	{
		$this->assertFalse(Environ::load(__DIR__ . 'notExistsDir'));
	}


	public function testOverrideAndLoadEnvDotIni()
	{
		$isEnvFound = Environ::load(__DIR__ . DIRECTORY_SEPARATOR . 'directory');

		$this->assertTrue($isEnvFound);

		$arrayVar = Environ::get('API_NAME');
		$this->assertArrayHasKey('API_KEY', $arrayVar);
		$this->assertSame($arrayVar['API_KEY'], 'newappkey');


		$this->assertSame(Environ::get('NULL_VAR'), '');
		$this->assertSame(Environ::get('NULL_VAR'), getenv('NULL_VAR'));

		$this->assertSame(Environ::get('TRUE_VAR'), '1');
		$this->assertSame(Environ::get('TRUE_VAR'), getenv('TRUE_VAR'));

		$this->assertSame(Environ::get('FALSE_VAR'), '');
		$this->assertSame(Environ::get('FALSE_VAR'), getenv('FALSE_VAR'));


		$this->assertSame(Environ::get('STR_VAR'), 'hello');
		$this->assertSame(Environ::get('STR_VAR'), getenv('STR_VAR'));


		$this->assertSame(Environ::get('FALSY'), '0');
		$this->assertSame(Environ::get('FALSY'), getenv('FALSY'));

	}


	public function testGetOnNonExistedKeyName()
	{
		$isEnvFound = Environ::load(__DIR__ . DIRECTORY_SEPARATOR . 'directory');

		$this->assertNull(Environ::get('key_is_not_existed'));

		$this->assertFalse(getenv('key_is_not_existed'));
	}


	public function testGetDefaultValue()
	{
		$this->assertFalse(Environ::get('key_is_not_existed', getenv('key_is_not_existed')));
		$this->assertTrue(Environ::get('key_is_not_existed', true));
	}


	public function testIsSapiCli()
	{
		$this->assertTrue(Environ::is('cli'));
	}

}
