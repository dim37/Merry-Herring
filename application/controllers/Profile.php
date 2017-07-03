<?php
class Profile extends CI_Controller
{
	public function __construct()
    {
            parent::__construct();
            $this->load->model('bd_connector');
    }
	public function friend_list($all = null){
			if(!isset($_COOKIE["hash"])){
				header("Location: /Home/index/");}
			if(is_null($all))
				$result = $this->bd_connector->get_all_user($_COOKIE["hash"]);		
			elseif ($all=="all") 
				$result = $this->bd_connector->show_my_all_invait_to_frend($_COOKIE["hash"]);	
			else
				$result = $this->bd_connector->gat_user_freand($_COOKIE["hash"]);
			$data["friend_type"]=$all;
			$arr=null;
			foreach ($result as $key => $value) {
				$arrForeach=null;
				foreach ($value as $key => $valueResult) {
					$arrForeach[]=$valueResult;
				}
					$arr[]=$arrForeach;
				}

			$this->load->view('Head');

			if($arr!=null)
			{
				$data["friend_list"]= $arr;
				$this->load->view('FriendList',$data);
			}		
	}
	public function profile($id=null){
			if(!isset($_COOKIE["hash"])){
				header("Location: /Home/index/");}
			if(is_null($id)){//текущий пользователь
				$result = $this->bd_connector->get_dop_info($_COOKIE["hash"]);	
			}
			else{//другой пользователь
				$result = $this->bd_connector->get_dop_info_for_user($id);	
			}
		
		$data["profile"]= $result;
		$this->load->view('Head');
			$this->load->view('Profile',$data);
	}

	public function edit_profile()
	{
		if(!isset($_COOKIE["hash"])){
			header("Location: /Home/index/");}

		if(isset($_POST["name"], $_POST["birthday"], $_POST["obaut"], $_POST["phone"], $_FILES['userfile']))
		{ 
			$rand = rand();
			$src=md5($_FILES['userfile']['name'].$rand);
			move_uploaded_file($_FILES['userfile']['tmp_name'], $src);

			

			header("Location: Ajax.html");
		}
	}

	public function add_friend($id){
		if(!isset($_COOKIE["hash"])){
				header("Location: /Home/index/");}
		$this->bd_connector->add_freand($_COOKIE["hash"],$id);
			header("Location: /Profile/friend_list/all");
	}
	public function drop_friend($id){
		if(!isset($_COOKIE["hash"])){
				header("Location: /Home/index/");}
		$this->bd_connector->drop_from_freand($_COOKIE["hash"],$id);
			header("Location: /Profile/friend_list/Something");
		}

	public function send_invait_to_friend($id){
		if(!isset($_COOKIE["hash"])){
				header("Location: /Home/index/");}
		$this->bd_connector->send_invait_to_frend($_COOKIE["hash"],$id);
		header("Location: /Profile/friend_list");
		}
}
?>