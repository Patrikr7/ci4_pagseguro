<?php

// BANCO DE DADOS
defined('HOSTNAME') || define('HOSTNAME', 'seu_hostname');
defined('USERNAME') || define('USERNAME', 'seu_username');
defined('PASSWORD') || define('PASSWORD', 'seu_password');
defined('DATABASE') || define('DATABASE', 'seu_database');


defined('BASE_URL') || define('BASE_URL', (!empty($_SERVER['HTTPS']) ? 'https://' . preg_replace('/index.php.*/', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']) : 'http://' . preg_replace('/index.php.*/', '', $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'])));

// DADOS PAGSEGURO
defined('PAG_ENV') || define('PAG_ENV', 'sandbox_ou_production');
defined('PAG_EMAIL') || define('PAG_EMAIL', 'seu_email');
defined('PAG_TOKEN') || define('PAG_TOKEN', 'seu_token');
defined('PAG_ID') || define('PAG_ID', '');
defined('PAG_KEY') || define('PAG_KEY', '');
defined('PAG_LOG') || define('PAG_LOG', WRITEPATH . "logs\pagseguro\log.log");