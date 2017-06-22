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
				setcookie('okey', 555, time() + 60*60*24*30);
		$data["message"]='Сообщение индекс';
		$this->load->view('header',$data);

		$data["content"]='Сообщение о том что все работает';
		$this->load->view('content',$data);
			echo 'все работает';

	}
	public function registration(){
			if(isset($_COOKIE["hash"])){
				header("Location: /Oleg/Merry-Herring/Home/index/");
			}
			elseif(isset($_POST["login"],$_POST["password"],$_POST["mail"])){
				$data['login']=$_POST["login"];
				$data['password']=$_POST["password"];
				$data['mail']=$_POST["mail"];
			}
			else{
				$data['login']=null;
				$data['password']=null;
				$data['mail']=null;
			}
			if(isset($_POST["error"]))
				$data['error']=$error;
			else
				$data['error']=null;
			
			$this->load->view('Registration',$data);
	}	

	public function registration_confirm($login=null,$password=null,$mail=null){
			$result = $this->bd_connector->registre_user($login,$password,$mail);	
			if($result===TRUE)
			{
				header("Location: /Oleg/Merry-Herring/Home/index/");
			}
			else
			{
				header("Location: /Oleg/Merry-Herring/Home/registration/".$login."/".$password."/".$mail);
			}

			

	}

	public function login($login=null,$password=null,$error=null){
			if(isset($_COOKIE["hash"])){
				header("Location: /Oleg/Merry-Herring/Home/index/");
			}
			$data['login']=$login;
			$data['password']=$password;
			$data['Error']=$error;
			$this->load->view('LoginIn',$data);
	}
	public function login_confirm($login="root@mail.ru",$password="root@mail.ru"){
		
		$result = $this->bd_connector->login_user($login,$password);
		if($result!="incorect login"&&$result!="incorrect password"){
			setcookie('hashes', $result, time() + 60*60*24*30,'/Oleg/Merry-Herring/');
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