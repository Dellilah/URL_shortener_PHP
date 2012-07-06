<?php
    /**
     * Configuration
     *
     * @package configuration.inc.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */
	
	// configuration of paths
    $paths['templates'] = dirname(dirname(__FILE__)) . '/templates/';

    // configuration of templates
    $templates['ext'] = '.tpl.php';
    $templates['error'] = '404';
	
	// configuration of database 
    $sql['host'] = 'localhost';
    $sql['user'] = 'user';
    $sql['password'] = 'password';
    $sql['database'] = 'password';
