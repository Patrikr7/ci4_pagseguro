<?php

// BANCO DE DADOS
defined('HOSTNAME') || define('HOSTNAME', 'localhost');
defined('USERNAME') || define('USERNAME', 'root');
defined('PASSWORD') || define('PASSWORD', 'senac');
defined('DATABASE') || define('DATABASE', 'ci4_pagseguro');


defined('BASE_URL') || define('BASE_URL', (!empty($_SERVER['HTTPS']) ? 'https://' . preg_replace('/index.php.*/', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) : 'http://' . preg_replace('/index.php.*/', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'])));

// DADOS PAGSEGURO
defined('PAG_ENV') || define('PAG_ENV', 'sandbox');
defined('PAG_EMAIL') || define('PAG_EMAIL', 'patrikr11@gmail.com');
defined('PAG_TOKEN') || define('PAG_TOKEN', '4686A1B6830841E09B4BCD068EE301B3');
defined('PAG_ID') || define('PAG_ID', '');
defined('PAG_KEY') || define('PAG_KEY', '');
defined('PAG_LOG') || define('PAG_LOG', WRITEPATH . "logs\pagseguro\log.log");