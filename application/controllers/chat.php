<?php
class chat extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('bd_connector');
        //$this->load->helper('url_helper');
    }

	public function index($i = null)
	{
	if(isset($_COOKIE["hash"])){
			$this->load->view('Head');
		if($i == null){
			$data['caht_info'] = $this->bd_connector->get_all_user_chat($_COOKIE["hash"]);
			$this->load->view('chat_index',$data);
		}
		else {
			$data['chat_info'] = $this->bd_connector->get_chat_info($_COOKIE["hash"],$i);
			$data['caht_mess'] = $this->bd_connector->get_all_chat_mess($_COOKIE["hash"],$i);
			$data['friend_list'] = $this->bd_connector->gat_user_freand($_COOKIE["hash"]);
			$data['chat_people_list'] = $this->bd_connector->get_all_chat_user($_COOKIE["hash"],$i);
			$this->load->view('chat_per',$data);
			}
		}
	}

	//Функционал чатиков
	public function create_chat($id){
		$this->bd_connector->create_chat_whiz($_COOKIE["hash"],$id);
		header("Location: /chat/index/");
	}
	public function send_chat_mess($id,$text){
		$this->bd_connector->send_chat_mess($_COOKIE["hash"],$id,$text);
		header("Location: /chat/index/".$id."/");
	}
	public function add_user_too_chat($id_chat){
		$this->bd_connector->add_user_too_chat($_COOKIE["hash"],$id_chat,$id_user);
		header("Location: /chat/index/".$id_chat."/");
	}
	public function drop_from_chat($id_chat){
		if(isset($_POST["friend"]))
		{
			echo $_POST["friend"];
			
			$this->bd_connector->drop_from_chat($_COOKIE["hash"],$id_chat,$_POST["friend"]);
				//header("Location: /chat/index/".$id_chat."/");
			echo "string";
		}
	}
}