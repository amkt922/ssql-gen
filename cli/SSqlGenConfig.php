<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ssql-gen-config
 *
 * @author p
 */
class SSqlGenConfig {
	public static $config = array(
		'ssqlDir' => '../../ssql/src/'
        , 'sqlDir' => '../test/sql/'
		, 'outDir' => '../test/output/'
        , 'database' => array('driver' => 'Mysql'
                              , 'dsn' => 'mysql:host=localhost;dbname=ssql_test'
                              , 'user' => 'root'
                              , 'password' => 'admin')
	);
}
