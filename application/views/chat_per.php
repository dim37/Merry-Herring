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

		
	 			<div align="center">
	       			<table >
						<tr>
		        			<td><img style="width: 50px; height: 50px;" src="<?php echo $chat_info['src']; ?>"/></td>
							<td><div style="font-size: 25px;"><?php echo $chat_info['name']; ?></div></td>
		    			</tr>
	    			</table>
				</div>
    <div>
         <table >
			
	    	<?php foreach ($caht_mess as $item): ?>
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
    </div>