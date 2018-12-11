<div class="container-fluid">
	<h1 class="text-center"> Blogg v1.0 Admin Login</h1>
	<p></p>

	<?php if(!empty(validation_errors())) {
		echo '<div class="alert alert-danger alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.validation_errors().'</div><br>';
	} ?>

	<div>
		<form id="login" method="POST">
			<div class="form-group">
				<label for="username"><b class="">Username</b></label>
				<input type="text" name="username" id="username" class="form-control" value="<?php echo set_value('username'); ?>" required>
			</div>
			<br>
			<div class="form-group">
				<label for="password" class=""><b>Password</b></label>
				<input type="password" name="password" id="password" class="form-control" required>
			</div>
			<br>
			<?php
			if($allAdmin < 1) { ?>
				<div class="form-group">
					<label for="name"><b class="">Name</b></label>
					<input type="text" name="name" id="name" class="form-control" value="<?php echo set_value('name'); ?>" required>
				</div>
				<div class="form-group">
					<label for="email"><b class="">Email</b></label>
					<input type="email" name="email" id="email" class="form-control" value="<?php echo set_value('email'); ?>" required>
				</div>
				<input type="submit" class="btn btn-primary" name="signupBtn" value="Signup">
			<?php }
			else { ?>
				<input type="submit" class="btn btn-success" name="loginBtn" value="Login">

			<?php } ?>
		</form>
	</div>
</div>