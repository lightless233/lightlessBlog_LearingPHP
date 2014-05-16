<?php

	class Admin_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library('session');
		}

		public function get_admin()
		{
			
		}

	}

?>