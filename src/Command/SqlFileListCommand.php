<?php

namespace SSqlGen\Command;

use SSqlGen\SSqlGenConfigure;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AbstractCommand
 *
 * @author p
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

