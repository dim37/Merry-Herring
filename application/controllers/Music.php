<?php
class Music extends CI_Controller
{
	
	public function music_list($all_musics=TRUE, $id='1'){
		$this->load->view('music_list');
	}	
	public function music($id='1'){
		$this->load->view('music');
	}	

}
?>