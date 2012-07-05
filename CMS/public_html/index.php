<?php
    /**
     * URL shortener
     *
     * @package index.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */
	 
	 include 'cms.h.php';
	 
	if(isset($_POST['long_url')){
		
		$url = new Url();
		
		$url->Shorten($_POST['long_url']);
		$site['data']['long_url'] = $url->long_url;
		$site['data']['short_url'] = $url->short_url;
	}
	else{
		$site['content'] = 'form';
	}

	screen_site($site);
?>
		
		
		