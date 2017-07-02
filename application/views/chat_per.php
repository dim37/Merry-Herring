 	<style type="text/css">
		.table
		{
			border-collapse: collapse;
			border: 1px solid #ddd;	
		}

		.table tr:hover
		{
			opacity: 0.9;
			background-color: RGB(132, 124, 134);
		}
		.table td img
		{
			width: 50px;
			height: 50px;
		}
		.divMess
		{
			width: 500px;
			font-size: 25px;
			text-align: center;
			word-wrap: break-word;
			text-align: left;
			margin: 5px;
		}
		.divNmae
		{
			width: 200px;
			height:25px; 
			font-size: 25px;
			text-align: center;
		}
	</style>
	<?php 
	$Add_list_people;
	if($friend_list!=null && $chat_people_list!=null)
	{
		$bool=true;
		foreach ($friend_list as $key => $value) {
			foreach ($chat_people_list as $key2 => $value2) {
				if($value==$value2)
					$bool=false;
			}
			if($bool)
				$Add_list_people[]=$value;
		}
	}

	 ?>
		
	 			<div align="center">
	 			Список сообщений<br/>
	 			Добавление участников в чат


				<form action="http://novk.com/chat/add_user_too_chat/<?php echo $chat_info['id']; ?>" method="POST">
				<select name="friend">
		 			<?php 
		    	if($Add_list_people!=null)
		    	foreach ($Add_list_people as $item): ?>
		    		<option name="friend" value="<?php echo $item->id_user; ?>"><?php echo $item->name; ?></option>
		    		<?php endforeach; ?>
		    	</select>
				<input type="submit" name="" value="Добавить" />
				</form>
				<?php 
				if($id_chat_roll['id_chat_roll']==1){
		 			echo 'Удаление участника из чата
					<form action="http://novk.com/chat/drop_from_chat/'.$chat_info["id"].'" method="POST"><select name="friend">';
			    	if($chat_people_list!=null)
			    	foreach ($chat_people_list as $item){
			    		echo '<option name="friend" value="'.$item->id_user.'">'.$item->name.'</option>';
			    	}
			    	echo '</select><input type="submit" name="" value="Выгнать" /></form>';
				}
				else
				{
					echo '<button type="button" class="RefBtn"><a href="http://novk.com/chat/exit_chat/'.$chat_info["id"].'">Сбежать</a></button>';
				}

			?>

	       			<table >
						<tr>
		        			<td><img style="width: 50px; height: 50px;" src="<?php echo $chat_info['src']; ?>"/></td>
							<td><div style="font-size: 25px;"><?php echo $chat_info['name']; ?></div></td>
		    			</tr>
	    			</table>
				</div>
    <div>
         <table >
			
	    	<?php 
	    	if($caht_mess!=null)
	    	foreach ($caht_mess as $item): ?>
	    		<tr>
	    		<td>
	    		<table class="table">
					<tr onclick="location.href='http://timwock.com/<?php echo $item->id_user; ?>'">
	    	    		<td style="vertical-align:top" ><img src="<?php echo $item->src; ?>"/></td>
						<td style="vertical-align:middle"><div class="divNmae"><?php echo $item->name; ?> : </div></td>
						<td><div class="divMess"><?php echo $item->text; ?></div></td>
	    	    	</tr>
    			</table>
    			</td>

	       </tr>
	    	<?php endforeach; ?>
    	</table>


<form action="http://novk.com/chat/send_chat_mes/<?php echo $chat_info['id']; ?>" method="POST">
Сообщение: <input type="text" name="text">
  <input type="submit" value="Отправить" />
</form>

    </div>