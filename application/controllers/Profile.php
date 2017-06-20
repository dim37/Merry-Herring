<?php
class Profile extends CI_Controller
{
	public function friend_list($all_people=TRUE,$id='1'){
		$this->load->view('friend_list');
	}
	public function profile($id='1'){
		$this->load->view('profile');
	}
}
?>