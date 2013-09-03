<?php
/*
  Copyright 2013, amkt922 <amkt922@gmail.com>

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
 */

namespace SSqlGen\Command;

/**
 * @author amkt922
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

