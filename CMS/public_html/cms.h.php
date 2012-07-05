<?php
    /**
     * Lib's including
     *
     * @package cms.h.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */
	 
	  // konfiguracja developerska:
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors','on');
	 
	include dirname(dirname(__FILE__)) . '/lib/inc/configuration.inc.php';
	include dirname(dirname(__FILE__)) . '/lib/inc/class.inc.php';
	include dirname(dirname(__FILE__)) . '/lib/inc/templates.inc.php';
	include dirname(dirname(__FILE__)) . '/lib/inc/database_service.inc.php';