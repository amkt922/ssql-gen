<?php

namespace SSqlGen;

require_once 'autoload.php';

use SSqlGen\Command\MenuCommand;
use SSqlGen\SSqlGenConfigure;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SSqlGenDispatcher
 *
 * @author p
 */
class SSqlGenDispatcher {

    /**
     * constructor
     */
    private function __construct() {
	}

	public static function run($config) {
		SSqlGenConfigure::config($config);
		$self = new self();
		$self->start();
	}

	public function start() {
		$cmd = new MenuCommand();	
		$cmd->show($cmd);
	}
}

