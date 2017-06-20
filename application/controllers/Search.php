<?php
class Search extends CI_Controller
{
	public function search($type='music'){
		$this->load->view('search');
	}	
}
?>