<?php declare(strict_types=1);
namespace AgungDhewe\Setingan;


final class Config
{
	const string SPARATOR = ".";

	private static array $_config;
	private static array $_usedConfig;
	private static string $_rootDir;


	public static function Setup(array $config) : void {
		self::$_config = $config;
	}


	public static function Set(string $keypath, mixed $value) : void {
		if (is_array(self::$_config)) {
			//TODO: masukkan keypath dengan value ke $_config 	
		}
	}

	public static function Get(?string $keypath = null) : mixed {
		try {
			if ($keypath!==null) {
				$value = self::getValueByPath(self::$_config, $keypath);
				return $value;
			} else {
				return self::$_config;
			}
		} catch (\Exception $ex) {
			throw $ex;
		}
	}


	public static function GetUsedConfig(string $name) : string {
		if (!array_key_exists($name, self::$_usedConfig)) {
			throw new \Exception("Config '$name' tidak ditemukan");
		}
		return self::$_usedConfig[$name];
	}

	public static function UseConfig(array $usedconfig) : void {
		self::$_usedConfig = $usedconfig;
	}

	private static function getValueByPath(array $array, string $path, ?string $separator = self::SPARATOR) : mixed {
		$keys = explode($separator, $path);
		foreach ($keys as $key) {
			if (!isset($array[$key])) {
				return null; // Kunci tidak ditemukan
			}
			$array = $array[$key]; // Melangkah lebih dalam ke array
		}
		return $array;
	}


	public static function setRootDir($dir) : void {
		if (!defined('__ROOT_DIR__')) {
			define('__ROOT_DIR__', $dir);
		}

		self::$_rootDir = $dir;
	}

	public static function getRootDir() : string {
		return self::$_rootDir;
	}

}