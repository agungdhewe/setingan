<?php declare(strict_types=1);
namespace AgungDhewe\Setingan;


class Config
{
	const SPARATOR = ".";

	private static array $_config;
	private static array $_usedConfig;
	private static string $_rootDir;

	/**
	 * Sets the root directory of the application.
	 *
	 * If the `__ROOT_DIR__` constant is not already defined, it will be defined with the provided directory.
	 *
	 * @param string $dir The root directory of the application.
	 *
	 * @return void
	 */
	public static function SetRootDir($dir) : void {
		if (!defined('__ROOT_DIR__')) {
			define('__ROOT_DIR__', $dir);
		}

		self::$_rootDir = $dir;
	}

	/**
	 * Gets the root directory of the application.
	 *
	 * @return string The root directory of the application.
	 */
	public static function GetRootDir() : string {
		return self::$_rootDir;
	}


	/**
	 * Sets up the configuration for the application.
	 *
	 * This function is used to initialize the configuration array with the provided values.
	 *
	 * @param array $config An associative array containing the configuration values.
	 *
	 * @return void
	 */
	public static function Setup(array $config) : void {
		self::$_config = $config;
	}


	
	/**
	 * Sets a configuration value.
	 *
	 * @param string $key   The key of the configuration value.
	 * @param mixed  $value The value to set.
	 *
	 * @return void
	 */
	public static function Set(string $keypath, mixed $value) : void {
		if (is_array(self::$_config)) {
			//TODO: masukkan keypath dengan value ke $_config 	
		}
	}


	/**
	 * Gets a configuration value.
	 *
	 * @param string $key     The key of the configuration value.
	 * @param mixed  $default The default value to return if the key is not set.
	 *
	 * @return mixed The configuration value, or the default value if not set.
	 */
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

	/**
	 * mark a key as a reference for used configuration.
	 *
	 * @param string $name The name of the user configuration value.
	 *
	 * @throws \Exception If the user configuration value is not found.
	 *
	 * @return string The user configuration value.
	 */
	public static function GetUsedConfig(string $name) : string {
		if (!array_key_exists($name, self::$_usedConfig)) {
			throw new \Exception("Config '$name' tidak ditemukan");
		}
		return self::$_usedConfig[$name];
	}

	/**
	 * Sets the used configuration key values.
	 *
	 * @param array $usedconfig An associative array containing the user configuration values.
	 *
	 * @return void
	 */
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




}