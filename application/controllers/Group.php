<?php
class Social extends CI_Controller
{
	public function group_list($all_groups=TRUE, $id='1'){
		$this->load->view('group_list');
	}	
	public function group($id='1'){
		$this->load->view('group');
	}	

}
?>