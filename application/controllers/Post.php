<?php
class Post extends CI_Controller
{
	public function post_list($all_posts=TRUE, $id='1'){
		$this->load->view('post_list');
	}	
	public function post($id='1'){
		$this->load->view('post');
	}	
}
?>