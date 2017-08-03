<?php
    class UserInfo{
		public $UserId;
		public $AccessLevel;
		
		function __construct($_UserId, $_AccessLevel)
		{
			$this->UserId = $_UserId;
			$this->AccessLevel = $_AccessLevel;
		}
	}
?>