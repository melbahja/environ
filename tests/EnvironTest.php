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

		$this->assertArrayHasKey('svn', Environ::get('urls'));
		$this->assertArrayHasKey('git', Environ::get('urls'));
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

		$this->assertSame(Environ::get('TRUE_VAR'), '1');

		$this->assertSame(Environ::get('FALSE_VAR'), '');
	}


	public function testGetOnNonExistedKeyName()
	{
		$isEnvFound = Environ::load(__DIR__ . DIRECTORY_SEPARATOR . 'directory');

		$this->assertNull(Environ::get('key_is_not_existed'));
	}


	public function testIsSapiCli()
	{
		$this->assertTrue(Environ::is('cli'));
	}

}
