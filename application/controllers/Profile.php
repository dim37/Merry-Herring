<?php
class Profile extends CI_Controller
{
	public function __construct()
    {
            parent::__construct();
            $this->load->model('bd_connector');
    }
	public function friend_list(){
		if(isset($_COOKIE["hash"])){
			$result = $this->bd_connector->gat_user_freand($_COOKIE["hash"]);	
			foreach ($result as $key => $value) {
				echo "{$key} => {$value}";
			}
		}
	}
	public function profile($id='1'){
		if(isset($_POST["login"]))
		{

		}
		//$this->load->view('profile');
	}
}
?>