<?php


namespace SSqlGen;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ssql-gen-config
 *
 * @author p
 */
class SSqlGenConfigure {
	private static $config;

	public static function config($config) {
		self::$config = $config;
	}

	public static function get($key) {
		return self::$config[$key];
	}
}
