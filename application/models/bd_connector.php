<?php

class bd_connector extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        public function get_all_user()
		{    
			$query = $this->db->get('users');
		    return $query->result_array();
		       
		}
}
 ?>