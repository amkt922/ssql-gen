<?php

namespace SSqlGen\Command;

use SSqlGen\SSqlGenConfigure;
use SSql\SSql;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractCommand
 *
 * @author p
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
[S] Start.
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

