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
	<label class="Head">Профиль</label>
	</center>
</div>
</center>
<div class="LoginContent">
	<tr>
		<td>
			<form action="http://novk.com/chat/edit_profile" method="post">
			<table>
					<?php
					if(!is_null($profile))
					{
						echo '
						<tr><th class="Head"><label> Айдишник: </label></th><th>'.$profile["id_user"].'</th></tr>
						<tr><th class="Head"><label> Имя: </label></th><th><input type="text" name="name" value="'.$profile["name"].'"/></th></tr>
						<tr><th class="Head"><label> День рождение: </label></th><th><input type="date" name="birthday" value="'.$profile["birthday"].'"/></th></tr>
						<tr><th class="Head"><label> О_пользователе: </label></th><th><input type="text" name="obaut" value="'.$profile["obaut"].'"/></th></tr>
						<tr><th class="Head"><label> Телефон: </label></th><th><input type="text" name="phone" value="'.$profile["phone"].'"/></th></tr>
						<tr><th class="Head"><label> Ссылка: </label></th><th>'.$profile["src"].'<input name="userfile" type="file" /></th></tr>';
					}
					?>
					<tr><th class="Head"></th><th><input type="submit" value="Сохранить"/></th></tr>';
			</table>
			</form>
		</td>
	</tr>
</div>
</div>
</form>