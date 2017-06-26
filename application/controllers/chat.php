<?php
class chat extends CI_Controller {

	
	public function __construct()
    {
        parent::__construct();
        $this->load->model('bd_connector');
        //$this->load->helper('url_helper');
    }

	public function index($i = 1)
	{

		$da = $this->bd_connector->login_user("root@mail.ru","root@mail.ru");
		if($i == null){
			$data['caht_info'] = $this->bd_connector->get_all_user_chat($da);
			$this->load->view('chat_index',$data);
		}
		else {
			$data['chat_info'] = $this->bd_connector->get_chat_info($da,$i);
			$data['caht_mess'] = $this->bd_connector->get_all_chat_mess($da,$i);
			$this->load->view('chat_per',$data);
		}
	}

}
