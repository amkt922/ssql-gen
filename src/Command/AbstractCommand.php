<?php

namespace SSqlGen\Command;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractCommand
 *
 * @author p
 */
abstract class AbstractCommand {


	const LF = PHP_EOL;

	const STDIN = 'php://stdin';

	const STDOUT = 'php://stdout';

	protected $in = null;

	protected $out = null;

	private $config = array();

    /**
     * constructor
     * @param array $config
     */
    public function __construct($config = null) {
		$this->in = fopen(self::STDIN, 'r');
		$this->out = fopen(self::STDOUT, 'w');
		if (!is_null($config)
				&& is_array($config)) {
			$this->config = $config;
		}
	}

	public function write($message) {
		fwrite($this->out, $message);
	}

	public function read() {
		return fgets($this->in);
	}
	
	abstract public function show();

	abstract public function process();
}

