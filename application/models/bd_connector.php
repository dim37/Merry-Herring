<?php

class bd_connector extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        //Получает хеш, и возвращает ID юзера
        public function get_id_user_hash($hash)
        {
        	$this->db->select('*');
			$this->db->from('hashes');
			$this->db->where('hash', $hash);
			$query = $this->db->get();
		    $val = $query->row_array();
		    return $val["id_user"];
        }
        // получает дополнительную иноформацию всех пользователей исключаяя текущего
        //	  $mass['id_user']   - int
		//	  $mass['name'] 	 - varchar
		//	  $mass['birthday']  - date
		//	  $mass['phone']	 - varchar
		//	  $mass['obaut'] 	 - text
		//	  $mass['src']		 - varchar
        public function get_all_user($hash)
		{    
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$query = $this->db->get('user_dop_info');

			$this->db->select('*,(SELECT COUNT(*) FROM users_freand WHERE users_freand.id_user_ov = '.$user_id.' AND users_freand.id_user_fr = user_dop_info.id_user AND users_freand.id_freand_type = 1) as frend');
			$this->db->from('user_dop_info');
			$this->db->where('id_user !=', $user_id);
			$query = $this->db->get();
		    return $query->result();
		       
		}
		// возврощяет "user name is taken !" если переммена $login содержет уже сушествуюущий в базе логин 
		// возврощяет "mail is taken !" если переммена $mail содержет уже сушествуюущий в базе майл 
		// возврощяет true в случаии успешного выполнения
		public function registre_user($login,$password,$mail)
		{

			$query = $this->db->get_where('user', array('name' => $login));
		    $val = $query->row_array();
		    if(count( $val ) != 0) 
		    {
		    	return "user name is taken !";
		    }

			$query = $this->db->get_where('user', array('email' => $mail));
		    $val = $query->row_array();
		    if(count( $val ) != 0) 
		    {
		    	return "mail is taken !";
		    }

			$d = rand();
			$solt =  md5 ($d . "|123|" . $d);
			$hashPassword = md5($password . $solt);

			$data = array(
			   'name' => $login,
			   'email' => $mail ,
			   'password' => $hashPassword ,
			   'solt' => $solt 
			);
			$this->db->insert('user', $data);	

			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('name', $login);
			$query = $this->db->get();
		    $val = $query->row_array();

			$user_id = $val["id"];


			$data = array(
			   'id_user' => $user_id,
			   'name' => $login ,
			   'birthday' => "" ,
			   'phone' => "" ,
			   'obaut' => "",
			   'src' => "" 
			);
			$this->db->insert('user_dop_info', $data);	

			return true;
		}
		// возврощяет "incorect login" если $login задан не правилно
		// возврощяет "incorrect password" если $password задан не правильно 
		// возврощяет $hash(защиты авторизации) если авторизация успешна 
		public function login_user($login,$password)
		{
			$query = $this->db->get_where('user', array('name' => $login));
		    $val = $query->row_array();
		    if(count( $val ) == 0) 
		    {
		    	return "incorect login";
		    }
		    $hashPassword = md5($password . $val["solt"]);
		    if($hashPassword ===  $val["password"])
		    {
		    	$query = $this->db->get_where('hashes', array('id_user' => $val["id"]));
		    	$result = $query->row_array();
		    	$nextWeek = time() + (1 * 24 * 60 * 60);
		    	$today = date("Y-m-d H:i:s",$nextWeek);  
		    	$hash = md5($today . $val["solt"]);
		    	if(count($result) == 0)
		    	{
		    		$data = array(
			 			'id_user' => $val["id"],
			 			'hash' => $hash ,
			   			'date' => $today,
					);
					$this->db->insert('hashes', $data);	
		    	}
		    	else
		    	{

		    		$data = array(
			 			'hash' => $hash ,
			   			'date' => $today,
					);
		    		$this->db->set($data);
					$this->db->where('id_user', $val["id"]);
					$this->db->update('hashes');
		    	}
		    	return $hash;
		    }
		    return "incorrect password";
		}
		// проверяет валидность авторизации 
		// возврощяет true если удачна ,false если нет 
		// в эхо(echo) выводит "1" если true , ""(не ошибка) если falseы
		public function chesc_hash($hash)
		{

			$query = $this->db->get_where('hashes', array('hash' => $hash));
		    $val = $query->row_array();
		    if(count( $val ) == 0) 
		    {
		    	return false;
		    }

		    $now      			= time();
    		$unix_date         	= strtotime($val['date']);
    		if($unix_date>$now)
    		{
    			if($val['hash'] == $hash)
    			{
    				return true;
    			}
    		}
    		return false;
		}
		// зменяет или создаёт дополнительную информацию о пользователе
		// возврощяет true если удачна 
		public function cheng_or_create_dop_info($hash,$name,$birtday,$obaut,$phone,$src)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('user_dop_info');
			$this->db->where('id_user', $user_id );
			$query = $this->db->get();
		    $val = $query->row_array();
		    if(count( $val ) == 0) 
		    {
		    	$data = array(
				   'id_user' => $user_id,
				   'name' => $name ,
				   'birthday' => $birtday ,
				   'phone' => $phone ,
				   'obaut' => $obaut,
				   'src' => $src 
				);
				$this->db->insert('user_dop_info', $data);	
		    }
		    else
		    {
		    	$data = array(
				   'name' => $name ,
				   'birthday' => $birtday ,
				   'phone' => $phone ,
				   'obaut' => $obaut,
				   'src' => $src 
				);
		    	$this->db->set($data);
				$this->db->where('id_user', $user_id);
				$this->db->update('user_dop_info');
		    }
		    return true;
		}
		// возврощяет масив доп информации пользователя 
		//	  $mass['id_user']   - int
		//	  $mass['name'] 	 - varchar
		//	  $mass['birthday']  - date
		//	  $mass['phone']	 - varchar
		//	  $mass['obaut'] 	 - text
		//	  $mass['src']		 - varchar
		public function get_dop_info($hash)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('user_dop_info');
			$this->db->where('id_user', $user_id );
			$query = $this->db->get();
			return $query->row_array();
		}
		// возврощяет масив доп информации друзей пользователя 
		//	  $mass[i]['id_user']   				- int
		//	  $mass[i]['name'] 	 					- varchar
		//	  $mass[i]['birthday']  				- date
		//	  $mass[i]['phone']	 					- varchar
		//	  $mass[i]['obaut'] 	 				- text
		//	  $mass[i]['src']		 				- varchar
		//	  $mass[i]['freand_type_name']			- varchar
		public function gat_user_freand($hash)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('user_dop_info.id_user,name,birthday,phone,obaut,src,freand_type_name');
			$this->db->from('user_dop_info');
			$this->db->join('users_freand', 'users_freand.id_user_ov = user_dop_info.id_user');
			$this->db->join('freand_type', 'freand_type.id = users_freand.id_freand_type');
			$this->db->where('id_user_fr ', $user_id );

			$this->db->where('id_freand_type', 1 );
			$query = $this->db->get();
		    return $query->result();
		}
		// пытаеться послать запрос на добовление в друзья 
		// возврощяет true если удачна ,false он уже состоит в друзьях или уже юыл отправлез запрос 
		public function send_invait_to_frend($hash,$frend_user_id)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('users_freand');
			$this->db->where('id_user_ov', $user_id);
			$this->db->where('id_user_fr', $frend_user_id);
			$query = $this->db->get();
		    $val = $query->row_array();
		    if(count($val) != 0)
		    {
		    	return false;
		    }

			$data = array(
			   'id_user_ov' => $user_id,
			   'id_user_fr' => $frend_user_id,
			   'id_freand_type'=> 2

			);
			$this->db->insert('users_freand', $data);	

		    return true;
		}
		// возврощяет масив доп информации подавших в заявку пользователя 
		//	  $mass[i]['id_user']   				- int
		//	  $mass[i]['name'] 	 					- varchar
		//	  $mass[i]['birthday']  				- date
		//	  $mass[i]['phone']	 					- varchar
		//	  $mass[i]['obaut'] 	 				- text
		//	  $mass[i]['src']		 				- varchar
		//	  $mass[i]['freand_type_name']			- varchar
		public function show_my_all_invait_to_frend($hash)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('user_dop_info.id_user,name,birthday,phone,obaut,src');
			$this->db->from('users_freand');
			$this->db->join('user_dop_info', 'user_dop_info.id_user = users_freand.id_user_ov');
			$this->db->where('id_user_fr', $user_id);
			$query = $this->db->get();
		    return $query->result();
		}
		// возврощяет информацию о пользователе 
		//	  $mass[i]['id_user']   				- int
		//	  $mass[i]['name'] 	 					- varchar
		//	  $mass[i]['birthday']  				- date
		//	  $mass[i]['phone']	 					- varchar
		//	  $mass[i]['obaut'] 	 				- text
		//	  $mass[i]['src']		 				- varchar
		public function get_dop_info_for_user($id)
		{
			$this->db->select('*');
			$this->db->from('user_dop_info');
			$this->db->where('id_user ', $id);
			$query = $this->db->get();
		    return $query->row_array();
		}
		// пытаеться принять заявку в  друзья если заявки нет то она отпроаляеться указанному другу
		// true - в случаии успешного выполнения
		public function add_freand($hash,$id)
		{
			$user_id = $this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('users_freand');
			$this->db->join('user_dop_info', 'user_dop_info.id_user = users_freand.id_user_ov');
			$this->db->where('id_user_fr', $user_id);
			$this->db->where('id_freand_type', 2 );
			$query = $this->db->get();
		    if( 0 == count( $query->result()))
		    {
		    	return $this->bd_connector->send_invait_to_frend($hash,$id);
		    }
		    else
		    {
		    	$data = array(
				   'freand_type_name' => 1 ,
				);
		    	$this->db->set($data);
				$this->db->where('id_user_fr', $user_id);
				$this->db->where('id_user_ov', $id);
				$this->db->update('users_freand');

				$data = array(
				   'id_user_fr' => $id,
				   'id_user_ov' => $user_id ,
				   'freand_type_name' => 1 
				);
				$this->db->insert('users_freand', $data);
				return true;	
		    }

		}
		// удаляет друга из списка друзей 
		// возврощяет true если удачна ,false если нет 
		public function drop_from_freand($hash,$id)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('users_freand');
			$this->db->join('user_dop_info', 'user_dop_info.id_user = users_freand.id_user_ov');
			$this->db->where('id_user_fr', $user_id);
			$this->db->where('id_freand_type', 1 );
			$query = $this->db->get();
		    if( 0 == count( $query->result()))
		    {
		    	return false;
		    }
		    else
		    {
		    	$this->db->where('id_user_fr', $user_id);
		    	$this->db->where('id_user_ov', $id);
		    	$this->db->delete('users_freand');

		    	$this->db->where('id_user_ov', $user_id);
		    	$this->db->where('id_user_fr', $id);
		    	$this->db->delete('users_freand');
		    	return true;	
		    }
		}
		// возврощяет true если удачна 
		public function create_chat_whiz($hash,$id)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$time = time();

			$data = array(
				'name' => 'диалог',
				'date_create' => $time,
				'src' => ''
			);
			$this->db->insert('chats', $data);

			$this->db->select('*');
			$this->db->from('chats');
			$this->db->where('date_create', $time);
			$this->db->where('name', 'диалог');
			$query = $this->db->get();
		    $val = $query->row_array();
			$chat_id = $val['id'];


			$data = array(
				'id_user' => $user_id,
				'id_chat' => $chat_id,
				'id_chat_roll' => 1
			);
			$this->db->insert('chat_user', $data);


			$data = array(
				'id_user' => $id,
				'id_chat' => $chat_id,
				'id_chat_roll' => 2
			);
			$this->db->insert('chat_user', $data);
			return true;
		}
		// true - в случаии успеха
		// false - в случаи провала
		public function cheng_chat_info($hash,$id,$name,$src)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('chat_user');
			$this->db->where('id_user', $user_id);
			$this->db->where('id_chat_roll', 1);
			$this->db->where('id_chat', $id);
			$query = $this->db->get();
		    $val = $query->row_array();

			if(count($val)== 0)
			{
				return false;
			}
			else
			{
				$data = array(
				   'name' => $name 
				);
		    	$this->db->set($data);
				$this->db->where('id', $id);
				$this->db->update('chats');
				return true;

			}
		}
		// true - в случаии успеха
		// false - в случаи провала
		public function send_chat_mess($hash,$id,$text)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('chat_user');
			$this->db->where('id_user', $user_id);
			$this->db->where('id_chat', $id);
			$query = $this->db->get();
		    $val = $query->row_array();

			if(count($val)== 0)
			{
				return false;
			}
			else
			{
				$data = array(
					'message' => $user_id,
					'id_chat' => $id,
					'text' => $text
				);
				$this->db->insert('message', $data);
				return true;

			}
		}
		// true - в случаии успеха
		// false - в случаи провала
		public function add_user_too_chat($hash,$id_chat,$id_user1)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('chat_user');
			$this->db->where('id_user', $user_id);
			$this->db->where('id_chat_roll', 1);

			$this->db->where('id_chat', $id_chat);
			$query = $this->db->get();
		    $val = $query->row_array();

			if(count($val)== 0)
			{
				return false;
			}
			else
			{

				$chat_id = $val['id'];
				$data = array(
					'id_user' => $id_user1,
					'id_chat' => $chat_id,
					'id_chat_roll' => 2
				);
				$this->db->insert('chat_user', $data);
				return true;

			}
		}
		// возврощяет информацию о чатах пользователя 
		//	  $mass[i]['id']   						- int
		//	  $mass[i]['name'] 	 					- varchar
		//	  $mass[i]['crc']  						- varchar
		public function get_all_user_chat($hash)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('chats.id,name,src');
			$this->db->from('chat_user');
			$this->db->join('chats', 'chats.id = chat_user.id_chat');
			$this->db->where('chat_user.id_user', $user_id);
			$query = $this->db->get();

		    return $query->result();
		}
		// возврощяет информацию о чатах пользователя 
		//	  $mass['id']   						- int
		//	  $mass['name'] 	 					- varchar
		//	  $mass['crc']  						- varchar
		public function get_chat_info($hash,$id)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('chats.id,name,src');
			$this->db->from('chat_user');
			$this->db->join('chats', 'chats.id = chat_user.id_chat');
			$this->db->where('chat_user.id_user', $user_id);
			$this->db->where('chat_user.id_chat', $id);
			$query = $this->db->get();

		    return $query->row_array();
		}
		// false - в случаи провала
		// в случаии успеха возврощяет масив сообщений
		//	  $mass[i]['id']   							- int
		//	  $mass[i]['id_user'] 	 					- int
		//	  $mass[i]['name']  						- varchar
		//	  $mass[i]['text']  						- varchar

		public function get_all_chat_mess($hash,$id_chat)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('chat_user');
			$this->db->where('id_user', $user_id);
			$this->db->where('id_chat', $id_chat);
			$query = $this->db->get();
		    $val = $query->result();

			if(count($val)== 0)
			{
				return false;
			}
			else
			{
				$this->db->select('message.id,user_dop_info.id_user,user_dop_info.name,user_dop_info.src,text');
				$this->db->from('message');

				$this->db->join('user_dop_info', 'user_dop_info.id_user = message.id_user');
				$this->db->where('id_chat', $id_chat);
				$query = $this->db->get();
		    	return $query->result();

			}
		}
		// возврощяет масив пользователей в чате
		//	  $mass[i]['id_user']   					- int
		//	  $mass[i]['name'] 	 						- varchar
		//	  $mass[i]['src']  							- varchar
		//	  $mass[i]['rool_name']  					- varchar
		public function get_all_chat_user($hash,$id_chat)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('chat_user.id_user,user_dop_info.name,user_dop_info.src,chat_roll.rool_name');
			$this->db->from('chat_user');
			$this->db->join('user_dop_info', 'user_dop_info.id_user = chat_user.id_user');
			$this->db->join('chat_roll', 'chat_roll.id = chat_user.id_chat_roll	');
			$this->db->where('id_chat', $id_chat);
			$query = $this->db->get();
		    return $query->result();
		}
		
		// true - в случаии успеха
		// false - в случаи провала
		public function drop_from_chat($hash,$id_chat,$id_user1)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('chat_user');
			$this->db->where('id_user', $user_id);
			$this->db->where('id_chat_roll', 1);
			$this->db->where('id_chat', $id_chat);
			$query = $this->db->get();
		    $val = $query->row_array();

			if(count($val)== 0)
			{
				return false;
			}
			else
			{
			    $this->db->where('id_user', $user_id1);
				$this->db->where('id_chat', $id_chat);
		    	$this->db->delete('users_freand');
				return true;

			}
		}
		// false - в случаи провала
		// в случаии успеха возврощяет масив сообщений
		//	  $mass[i]['id']   							- int
		//	  $mass[i]['id_user'] 	 					- int
		//	  $mass[i]['name']  						- varchar
		//	  $mass[i]['text']  						- varchar

		public function get_last_chat_mess($hash,$id_chat,$id_last)
		{
			$user_id = 	$this->bd_connector->get_id_user_hash($hash);

			$this->db->select('*');
			$this->db->from('chat_user');
			$this->db->where('id_user', $user_id);
			$this->db->where('id_chat', $id_chat);
			$query = $this->db->get();
		    $val = $query->row_array();

			if(count($val)== 0)
			{
				return false;
			}
			else
			{
				$this->db->select(' message.id,user_dop_info.id_user,user.name,text');
				$this->db->from('message');

				$this->db->join('user_dop_info', 'user_dop_info.id_user = message.id_user');
				$this->db->where('id_chat', $id_chat);

				$this->db->where('id >', $id_last);
		    	return $query->row_array();

			}
		}
}
 ?>