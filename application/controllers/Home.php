<?php
class Home extends CI_Controller
{
	public function __construct()
    {
            parent::__construct();
            $this->load->model('bd_connector');
            /*$this->load->helper('url_helper');*/
    }


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
			echo 'все работает';
	}
	public function registration(){
		/*$this->load->view('registration');*/
		echo "registration";
	}	

	public function registration_confirm($login="root2@mail.ru",$password="root2@mail.ru",$mail="root2@mail.ru"){
			$result = $this->bd_connector->registre_user($login,$password,$mail);
			/*redirect('/Home/registration/');*/
			/*header("Location: /registration/");*/
			if($result===TRUE)
			{
				echo $result;
			}
			else
			{
				echo "Ошибка".$result;
			}

			

	}

	public function login(){
		/*$this->load->view('login');*/
		echo "login";
	}
	public function login_user($login="root@mail.ru",$password="root@mail.ru"){
		

		$result = $this->bd_connector->login_user($login,$password);
		echo $result;
		if($result!="incorect login"&&$result!="incorrect password"){echo "Все верно";}
		
	}




	public function exit_profile(){
		if(isset($_COOKIE["hash"]))
		{
			setcookie('hash', " ", time() - 1000000);
		}
	}

	
}
?>