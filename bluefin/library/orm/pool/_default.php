<?php
namespace library\orm\pool;
class _default implements \library\orm\pool,\component\injector
{
	private static $connection = array();
	private static $_locator   = null;

	public static function addConnection($db, \library\orm\connection $connection, $master=true)
	{
		$type = $master ? 'master' : 'slave';
		static::$connection[$db][$type][] = $connection;
	}

	public static function getConnection($db, $master=true)
	{
		$type = $master ? 'master' : 'slave';
		if(isset(static::$connection[$db][$type])) {
			$index = array_rand(static::$connection[$db][$type]);
			return static::$connection[$db][$type][$index];
		}

		return null;
	}

	public static function removeConnection($db, $master=true)
	{
		$type = $master ? 'master' : 'slave';
		if(isset(static::$connection[$db][$type])) {
			unset(static::$connection[$db][$type]);
		}
	}

	public static function flushConnection()
	{
		static::$connection = array();
	}

	public function __get($db)
	{
		return static::getConnection($db);
	}

	public function __set($db, \library\orm\connection $connection)
	{
		static::addConnection($db, $connection);
	}

	public static function inject(\component\locator $locator)
	{
		static::$_locator = $locator;
	}
}
