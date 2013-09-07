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

    const TITLE_MARK = '[ssql:title]';

    const DESC_MARK = '[ssql:description]';

	public function process() {
		$sqlDir = SSqlGenConfigure::get('sqlDir');	
		$files = scandir($sqlDir);
		$sqlList = array();
		foreach ($files as $file) {
			if ($file === '.' || $file === '..') {
				continue;
			}
			// enum value from filename. e.g. selectUser.sql to SELECT_USER
            $value = str_replace('.sql', '', $file);
			$keyName = $value;
		    $keyName = preg_replace('/([A-Z])/', '_$1', $keyName);  
			$keyName = strtoupper($keyName);
            $contents = file_get_contents($sqlDir . $file);
            $title = $this->getSqlTitle($contents);
			$sqlList[$keyName] = array('file' => $value, 'title' => $title);
		}

		$def = $this->renderTemplate(compact('sqlList'));
		$outDir = SSqlGenConfigure::get('outDir');
		file_put_contents($outDir . self::TEMPLATE_FILE, $def);
	}

    private function getSqlTitle($contents) {
        $titlePos = strpos($contents, self::TITLE_MARK);
        $title = '';
        if ($titlePos !== false) {
            $titlePos +=  mb_strlen(self::TITLE_MARK);
            $descPos = strpos($contents, self::DESC_MARK);
            if ($descPos !== false) {
                $title = mb_substr($contents, $titlePos, $descPos - $titlePos);
            } else {
                $endCommentPos = strpos($contents, '*/', $titlePos);
                $title = mb_substr($contents, $titlePos, $endCommentPos - $titlePos);
            }
        }
        $title = str_replace(array(' ', '*', "\r", "\n"), '', trim($title));
        return $title;
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

