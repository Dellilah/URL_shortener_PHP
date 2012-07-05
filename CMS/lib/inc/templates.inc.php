<?php
    /**
     * Templates
     *
     * @package templates.inc.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */

    /**
     * Screen site
     * 
     * @param array $paths array storing paths
     * @param array $templates array of templates' settings
     * @param array $site array od data needed on the page
     * @param string $layout
     * 
     */
    function screen_site($paths, $templates, $site, $layout = 'index.tpl.php') {
        include $paths['templates'] . $layout;
    }
