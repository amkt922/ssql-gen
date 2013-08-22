<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../src/SSqlGenDispatcher.php';
require_once 'SSqlGenConfig.php';

use SSqlGen\SSqlGenDispatcher;

SSqlGenDispatcher::run(SSqlGenConfig::$config);

