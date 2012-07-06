<?php
    /**
     * Short URL stats
     *
     * @package stats.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */
	 
	 include 'cms.h.php';
	 
	if(isset($_POST['short_url'])){
		$site['whole_url'] = $_POST['short_url'];
		$part_url = substr($site['whole_url'], -6, 6);
		$site['url'] = download_data($sql, 'Url', array('*'), array('short_url' => $part_url));
		
		if(count($site['url']) && count($site['url']) > 0){
			$site['url'] = current($site['url']);
			$site['content'] = 'stats_result';
		}
		else{
			$site['content'] = 'form';
			$site['errors'] = 'No matching URL in Database. Try again.';
		}
	}
	else{
		$site['content'] = 'form';
	}
	
	screen_site($paths, $templates, $site);
?>