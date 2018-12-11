<div class="container-fluid">
	<h1 class="text-center">Create New Post</h1>
	<p></p>
	<section class="container">
		<p></p>
		<br>
		 <?php if(!empty(validation_errors())) {
			echo '<div class="alert alert-danger alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.validation_errors().'</div><br>';
		} ?>
		<?php if(!empty($this->session->flashdata('success_alert'))) {
			echo '<div class="alert alert-success alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('success_alert').'</div><br>';
		} ?>
		<?php echo form_open(); ?>
			<div class="form-group">
				<label>Title</label>
				<input class="form-control" type="text" name="title">
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control"></textarea>
			</div>
			<div>
				<input class="btn btn-success" type="submit" name="create_post" value="Create">
			</div>
		</form>