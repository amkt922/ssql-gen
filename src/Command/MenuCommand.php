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

	public function show() {
		$menu = <<<MENU
[E] Generate Entity classes.
[O] Generate Outside sql enum definition.
[Q] [Q]uit.
MENU;
		$this->write($menu);	
		$input = trim($this->read());	

		switch ($input) {
		case 'E':
			$cmd = new CreateEntityCommand();
			$cmd->show();
			break;
		case 'O':
			$cmd = new SqlFileListCommand();
			$cmd->show();
			break;
		case 'Q':
			$this->write('Quit');	
			break;
		default:
			break;
		}
        exit();
	}
}

