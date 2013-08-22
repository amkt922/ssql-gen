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
class MenuCommand extends AbstractCommand {

	public function process() {
		
	}

	public function show($prevCmd) {
		$menu = <<<MENU
[A] Generate outside sql enum definition.
[B] Generate entity classes.
[Q] Quit.
MENU;
		$this->write($menu);	
		$input = trim($this->read());	

		switch ($input) {
		case 'A':
			$aCmd = new SqlFileListCommand();
			$aCmd->show($this);
			break;
		case 'B':
			break;
		case 'Q':
			$this->write('Quit');	
			exit();
			break;
		default:
			$prevCmd->show($this);
			break;
		}
	}
}

