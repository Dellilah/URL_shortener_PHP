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
		
		//shortening with uniqueness checking
		do{
			$url->Shorten($_POST['long_url']);
			$is_unique = count(download_data($sql, 'Url', array('*'), array('short_url' => ($url->short_url))));
		}
		while($is_unique > 0);
		
		$site['data']['long_url'] = $url->long_url;
		$site['data']['short_url'] = $url->short_url;
		
		$pattern = array('long_url', 'short_url');
		
		if(insert_data($sql, 'Url', $site['data'], $pattern)){
			$site['content'] = 'result';
			$site['data']['existing'] = download_data($sql, 'Url', array('*'));
		}
		else{
			$site['errors'] = 'Saving data failed';
			$site['content'] = 'form';
		}
	}
	
	elseif(isset($_GET['u'])){
		if($url = current(current(download_data($sql, 'Url', array('long_url'), array('short_url' => $_GET['u']))))){
			header("Location: ".$url); 		}
		else{
			
			$site['errors'] = 'Unknown adress';
			$site['content'] = 'form';
		}	
	}
	
	else{
		$site['content'] = 'form';

	}

	screen_site($paths, $templates,$site);
?>
		
		
		