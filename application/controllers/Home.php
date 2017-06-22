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
	public function registration($login=null,$password=null,$mail=null,$error=null){
		if(!is_null($login)&&!is_null($password)&&!is_null($mail)){
			$data['login']=$login;
			$data['password']=$password;
			$data['mail']=$mail;
			if(!is_null($error))
			{
				$data['error']=$error;
			}
			/*$this->load->view('registration',$data);*/
		}

		
		echo "registration";
	}	

	public function registration_confirm($login=null,$password=null,$mail=null){
			$result = $this->bd_connector->registre_user($login,$password,$mail);
			/*redirect('/Home/registration/');*/
		
			if($result===TRUE)
			{
				header("Location: /Oleg/Merry-Herring/Home/index/");
			}
			else
			{
				echo "Ошибка ".$result;
			}

			

	}

	public function login($login=null,$password=null,$error=null){
		

		if(!is_null($login)&&!is_null($password)){
			$data['login']=$login;
			$data['password']=$password;
			if(!is_null($error))
			{
				$data['error']=$error;
			}
			/*$this->load->view('login',$data);*/
		}
		else{
			/*$this->load->view('login');*/
			echo "login";
		}

	}
	public function login_user($login="root@mail.ru",$password="root@mail.ru"){
		
		$result = $this->bd_connector->login_user($login,$password);
		if($result!="incorect login"&&$result!="incorrect password"){
			header("Location: /Oleg/Merry-Herring/Home/index/");
		}
		else {
			header("Location: /Oleg/Merry-Herring/Home/login/".$login."/".$password);
		}
		
	}

	public function exit_profile(){
		if(isset($_COOKIE["hash"]))
		{
			setcookie('hash', " ", time() - 1000000);
		}
	}

	
}
?>