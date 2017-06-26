<style>
	body{
		
		background: url(Ressourse/BackgroundNOVK.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
	}
	div.Login{
		margin: auto;
    	margin-top:15%;
    	width: 450px;
	}
	div.LoginContent{
		width: 450px;
    	padding: 10px;
    	background: linear-gradient(to top left, rgba(72, 61, 139, 0.9), rgba(186, 85, 211, 0.9));
    	border-radius: 8px;
	}
	label{
		margin: 10px;
		padding: 5px;
		color: Violet;
		font-family: comic sans ms;
	}
	input.Inp{
		margin: 10px;
		background-color: Indigo;
		color: Violet;
		padding: 5px;
		border-color: Purple;
		border-radius: 8px;
		font-family: comic sans ms;
	}
	input.Enter{
		width: 80%;
	}
	button.RefBtn{
		padding: 5px;
		font-family: comic sans ms;
		border-color:Purple;
		border-radius: 8px;
		background-color: Indigo;
	}
	a{
		vertical-align: middle;
		text-decoration: none;
		color: Violet;
	}
	table{
		width: 100%;
	}
	th.Head{
		width: 100px;
	}
	div.Rigth{
		margin-left: 50%;
	}
	div.LoginHead{
		width: 250px;
		background: linear-gradient(to top left, rgba(72, 61, 139, 0.9), rgba(186, 85, 211, 0.9));
    	border-radius: 8px 8px 0 0;
		padding: 10px;
		text-align: center;
	}
	label.Head{
		font-size: 32px;
	}

</style>

<form action="login" method="post">
<div class="Login">
<center>
<div class="LoginHead">
<center>
	<label class="Head">Профили</label>
	</center>
</div>
</center>
<div class="LoginContent">
	<tr>
		<td>
			<table>
								<?php
					if(!is_null($friend_list))
					{

						foreach ($friend_list as $key => $profile) {
						echo "<tr><th class='Head'<label>Ключ</label></th><th>{$key}</th></tr>";
						echo '<tr><th class="Head"><label> Айдишник: </label></th><th>'.$profile[0].'</th></tr>
						<tr><th class="Head"><label> Имя: </label></th><th>'.$profile[1].'</th></tr>
						<tr><th class="Head"><label> День рождение: </label></th><th>'.$profile[2].'</th></tr>
						<tr><th class="Head"><label> О_пользователе: </label></th><th>'.$profile[3].'</th></tr>
						<tr><th class="Head"><label> Телефон: </label></th><th>'.$profile[4].'</th></tr>
						<tr><th class="Head"><label> Ссылка: </label></th><th>'.$profile[5].'</th></tr>';
						if(count($profile)==7){
							echo $profile[6];
							if($profile[6]==1||$profile[6]=="frend")
							{
								echo'<tr><th></th><th class="Head"><button type="button" class="RefBtn"><a href="drop_friend/'.$profile[0].'">Удалить из друзей</a></button></th></tr>';
							}
							else{
								echo'<tr><th></th><th class="Head"><button type="button" class="RefBtn"><a href="add_friend/'.$profile[0].'">Добавить в друзья</a></button></th></tr>';
							}
						}
						else
							echo'<tr><th></th><th class="Head"><button type="button" class="RefBtn"><a href="drop_friend/'.$profile[0].'">Удалить из друзей</a></button></th></tr>';

						echo'<tr><th class="Head"><label></label></th><th></th></tr>';
					}
					}
					?>
			</table>
		</td>
	</tr>
</div>
</div>
</form>