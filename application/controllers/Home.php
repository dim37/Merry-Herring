<?php
class Home extends CI_Controller
{
	public function __construct()
    {
            parent::__construct();
            $this->load->model('bd_connector');
    }
	public function index(){
		$this->load->view('Head');	
		$data["message"]='Сообщение индекс';
		$this->load->view('header',$data);

		$data["content"]='Сообщение о том что все работает';
		$this->load->view('content',$data);

	}
	public function registration(){
			if(isset($_COOKIE["hash"])){
				header("Location: /Oleg/Merry-Herring/Home/index/");
			}
			elseif(isset($_POST["login"],$_POST["password"],$_POST["email"])){
				$result = $this->bd_connector->registre_user($_POST["login"],$_POST["password"],$_POST["email"]);	
				if($result===TRUE){
					$result = $this->bd_connector->login_user($_POST["login"],$_POST["password"]);
					setcookie('hash', $result, time() + 60*60*24*30,'/Oleg/Merry-Herring/');
					header("Location: /Oleg/Merry-Herring/Home/index/");
				}
				else{
					$data['login']=$_POST["login"];
					$data['password']=$_POST["password"];
					$data['email']=$_POST["email"];
					$data['error']=$result;
				}
			}
			else{
				$data['login']=null;
				$data['password']=null;
				$data['email']=null;
				$data['error']=null;
			}			
			$this->load->view('Head');
			$this->load->view('Registration',$data);
	}	

	public function login(){
			if(isset($_COOKIE["hash"])){
				header("Location: /Oleg/Merry-Herring/Home/index/");
			}
			elseif(isset($_POST["login"],$_POST["password"])){
				$result = $this->bd_connector->login_user($_POST["login"],$_POST["password"]);
				if($result!="incorect login" && $result!="incorrect password"){
					setcookie('hash', $result, time() + 60*60*24*30,'/Oleg/Merry-Herring/');
					header("Location: /Oleg/Merry-Herring/Home/index/");
				}
				else {
					$data['login']=$_POST["login"];
					$data['password']=$_POST["password"];
					$data['error']=$result;	
				}
			}
			else{
				$data['login']=null;
				$data['password']=null;
				$data['error']=null;
			}
			$this->load->view('Head');
			$this->load->view('LoginIn',$data);
	}

	public function exit_profile(){
		if(isset($_COOKIE["hash"]))
		{
			setcookie('hash', " ", time() - 1000000);
		}
	}	
}
?>