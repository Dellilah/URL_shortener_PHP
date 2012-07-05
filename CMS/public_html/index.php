<?php
    /**
     * URL shortener
     *
     * @package index.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */
	 
	 include 'cms.h.php';
	 
	if(isset($_POST['long_url'])){
		
		$url = new Url();
		
		$url->Shorten($_POST['long_url']);
		$site['data']['long_url'] = $url->long_url;
		$site['data']['short_url'] = $url->short_url;
		
		$pattern = array('long_url', 'short_url');
		
		if(insert_data($sql, 'Url', $site['data'], $pattern)){
			$site['content'] = 'result';
		}
		else{
			$site['content'] = 'form';
		}
	}
	else{
		$site['content'] = 'form';

	}

	screen_site($paths, $templates,$site);
?>
		
		
		