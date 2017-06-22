<style>
	body{
		
		background: url(Ressourse/BackgroundNOVK.jpg) no-repeat;
		background-size: 100%;
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

<form action="http://localhost/Oleg/Merry-Herring/Home/registration" method="post">
<div class="Login">
<center>
<div class="LoginHead">
<center>
	<label class="Head">Регистрация</label>
	</center>
</div>
</center>
<div class="LoginContent">
	<tr>
		<td>
		<?php
		if(!is_null($error))
		{
			echo '<tr>
				<th>
					<label> * </label>
				</th>
				<th>
					<label>'.$error.'</label>
				</th>
			</tr>';
		}
		?>
		</td>
		<td>
			<table>
				<tr>
					<th class="Head">
						<label>Логин: </label>
					</th>
					<th>
					<?php
					if(!is_null($login))
					{
						echo '<input type="text" name="login" value="'.$login.'" maxlength="32" class="Enter Inp"/>';
					}
					else{
						echo '<input type="text" name="login" maxlength="32" class="Enter Inp"/>';
					}
					?>
					</th>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<th class="Head">
						<label>Почта: </label>
					</th>
					<th>
					<?php
					if(!is_null($email))
					{
						echo '<input type="text" name="email" value="'.$email.'" maxlength="100" class="Enter Inp"/>';
					}
					else{
						echo '<input type="text" name="email" maxlength="100" class="Enter Inp"/>';
					}
					?>
					</th>
				</tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<th class="Head">
						<label>Пароль: </label>
					</th>
					<th>
					<?php
					if(!is_null($password))
					{
						echo '<input type="Password" name="password" value="'.$password.'" maxlength="32" class="Enter Inp"/>';
					}
					else{
						echo '<input type="Password" name="password" maxlength="32" class="Enter Inp"/>';
					}
					?>
					</th>
				</tr>
			</table>
		</td>
		<td hidden="hidden">
			<table>
				<tr>
					<th class="Head">
						<label>Повторить пароль: </label>
					</th>
					<th>
						<input type="Password" name="repassword" maxlength="32" class="Enter Inp"/>
					</th>
				</tr>
			</table>
		</td>
		<td>
			<center>
				<button type="button" class="RefBtn"><a href="login">Вход</a></button>
				<input type="submit" name="Submit" class="Inp">
			</center>
		</td>
	</tr>
</div>
</div>
</form>