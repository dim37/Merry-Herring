<?php
class Home extends CI_Controller
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

		if(!isset($_COOKIE["hash"]))
		{
			$hash = md5(mt_rand(10000,1000000));
			setcookie('hash', $hash, time() + 60*60*24*30);
		}

		$data["message"]='Сообщение индекс';
		$this->load->view('header',$data);

		$data["content"]='Сообщение о том что все работает';
		$this->load->view('content',$data);
			echo 'все работает';
	}
	public function registration(){
		$this->load->view('registration');
	}	
	public function login(){
		$this->load->view('login');
	}


	public function exit_profile(){
		if(isset($_COOKIE["hash"]))
		{
			setcookie('hash', " ", time() - 1000000);
		}
	}

	
}
?>