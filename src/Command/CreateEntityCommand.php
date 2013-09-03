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
use SSql\SSql;

/**
 * @author amkt922
 */
class CreateEntityCommand extends AbstractCommand {

    const TEMPLATE_FILE = 'Entity.php';

	public function process() {
		$database = SSqlGenConfigure::get('database');
        $ssql = SSql::connect(compact('database'));
        $sQry = $ssql->createSQry();
        $tables = $sQry->tables();
		foreach ($tables as $table) {
            $columns = $sQry->columnsOf($table);
            $className = str_replace(' ', '', ucwords(str_replace('_', ' ', $table)));
            $tableName = $table;
            $def = $this->renderTemplate(compact('tableName', 'columns', 'className'));
            $outDir = SSqlGenConfigure::get('outDir');
            file_put_contents($outDir . $className . '.php', $def);
		}
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
[S] Start to create.
MENU;
		$this->write($menu);	
		$input = trim($this->read());	

		switch ($input) {
		case 'S':
			$this->process();
			$this->write('done.');	
			break;
		default:
			break;
		}
	}
}

