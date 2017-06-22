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
			if(true){
				$result = $this->bd_connector->get_all_user($_COOKIE["hash"]);	
				echo "string";
				echo count($result);
				foreach ($result as $key => $value) {
					echo "{$key} => {$value}";
				}
					
			}
				else{
				$result = $this->bd_connector->gat_user_freand($_COOKIE["hash"]);	
				foreach ($result as $key => $value) {
					echo "{$key} => {$value}";
				}
			}
		}
		$this->load->view('Head');	
	}
	public function profile($id='1'){
		if(isset($_POST["login"]))
		{

		}
		//$this->load->view('profile');
	}
}
?>