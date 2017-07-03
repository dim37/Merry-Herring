
	<style type="text/css">
		.table
		{
			border-collapse: collapse;	
		}
		th, td {
		    border-bottom: 1px solid #ddd;
		}

		tr:hover
		{
			opacity: 0.9;
			background-color: RGB(132, 124, 134);
		}
		td img
		{
			width: 50px;
			height: 50px;
		}
		td div
		{
			width: 500px;
			height:25px; 
			font-size: 25px;
			text-align: center;
		}
	</style>

  	<div  style="width: 75%; display: inline-block; margin:15px">
  	<button type="button" class="RefBtn"><a href="http://novk.com/chat/create_chat">Создать чатик</a></button>
  	Список чатов
        <table class="table">
	    <?php foreach ($all_user as $item): ?>
			<tr onclick="location.href='http://novk.com/chat/index/<?php echo $item->id; ?>'">
	        	<td><img src="<?php echo $item->src; ?>"/></td>
				<td><div><?php echo $item->name; ?></div></td>
	        </tr>
	        
	    <?php endforeach; ?>
    	</table>
    </div>