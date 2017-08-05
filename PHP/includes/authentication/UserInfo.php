<?php
    class UserInfo{
		public $UserId;
		public $AccessLevel;
		public $Role;
		
		function __construct($_UserId, $_AccessLevel, $_Role)
		{
			$this->UserId = $_UserId;
			$this->AccessLevel = $_AccessLevel;
			$this->Role = $_Role;
		}
	}
?>