<?php
    /**
     * URL class
     *
     * @package class.inc.php
     * @author Alicja Cyganiewicz
     * @since 05.07.2012
     */
	 
	
	class Url
	{
		$long_url;
		$short_url;
		$riderections = 0;
		
		function Shorten($url){
			$this->long_url = $url;
			$this->short_url ='id=2';
		}
		
	}