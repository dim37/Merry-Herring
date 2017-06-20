<?php
class Pages extends CI_Controller
{
	public function view($page='home'){
		echo 'все работает';
		echo ' страница '.$page;
	}
	public function viewSum($page='6',$page2='5'){
		echo 'все работает';
		echo ' Ваше число '.($page+$page2);
	}

	public function index(){
		$data["message"]='Сообщение индекс';
		$this->load->view('header',$data);

		$data["content"]='Сообщение о том что все работает';
		$this->load->view('content',$data);

	}
	
}
?>