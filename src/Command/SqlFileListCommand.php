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

use SSqlGen\SSqlGenConfigure;

/**
 * @author amkt922
 */
class SqlFileListCommand extends AbstractCommand {

	const TEMPLATE_FILE = 'SqlFiles.php';

	public function process() {
		$sqlDir = SSqlGenConfigure::get('sqlDir');	
		$files = scandir($sqlDir);
		$sqlList = array();
		foreach ($files as $file) {
			if ($file === '.' || $file === '..') {
				continue;
			}
			// enum value from filename. e.g. selectUser.sql to SELECT_USER
			$keyName = str_replace('.sql', '', $file);	
		    $keyName = preg_replace('/([A-Z])/', '_$1', $keyName);  
			$keyName = strtoupper($keyName);
			$sqlList[$keyName] = $file;
		}

		$def = $this->renderTemplate(compact('sqlList'));
		$outDir = SSqlGenConfigure::get('outDir');
		file_put_contents($outDir . self::TEMPLATE_FILE, $def);
	}

	private function renderTemplate($params) {
		extract($params);
		ob_start();
		include __DIR__ . '/Template/' . self::TEMPLATE_FILE;
		$c = ob_get_contents();
		ob_end_clean();
		return $c;
	}

	public function show() {
		$menu = <<<MENU
[A] Start.
MENU;
		$this->write($menu);	
		$input = trim($this->read());	

		switch ($input) {
		case 'A':
			$this->process();
			$this->write('done.');	
			break;
		default:
			break;
		}
	}
}

