<?php
class Album extends CI_Controller
{
	
	public function album_list($id='1'){
		$this->load->view('album_list');
	}	
	public function album($id='1'){
		$this->load->view('album');
	}	
	public function image($id='1'){
		$this->load->view('image');
	}	

}
?>