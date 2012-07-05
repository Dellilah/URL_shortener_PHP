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
		public $long_url;
		public $short_url;
		private $riderections = 0;
		
		function Shorten($url){
			$this->long_url = $url;
			
			$chars = str_split('abcdefgijklmnopqrstqxyzABCDEGHIJKLMNOPQRSTUWXYZ1234567890');
			
			$random_string = '';
			for($i=0;$i<6;$i++){
				$random_string .= $chars[rand(0, count($chars)-1)];
			}
			
			$this->short_url = $random_string;
		}
		
	}