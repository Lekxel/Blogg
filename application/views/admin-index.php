<div class="container">
	<h1 class="text-center"> Blogg v1.0 Admin Dashboard</h1>
	<p></p>
	<div class="container">
		<?php if(!empty(validation_errors())) {
			echo '<div class="alert alert-danger alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.validation_errors().'</div><br>';
		} ?>
		<?php if(!empty($this->session->flashdata('success_alert'))) {
			echo '<div class="alert alert-success alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('success_alert').'</div><br>';
		} ?>
		<?php if(!empty($this->session->flashdata('error_alert'))) {
			echo '<div class="alert alert-danger alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('error_alert').'</div><br>';
		} ?>
		<section>
			<h3 class="text-center">Update Site Settings</h3>
			<p></p>
			<form method="POST">
				<div class="form-group">
					<label for="site_name">Site Name</label>
					<input type="text" name="site_name" value="<?=$site_name; ?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="allow_comment">Allow Comment?</label>
					<select name="allow_comment" class="form-control">
						<option disabled="disabled" selected="selected">Select</option>
						<option value="TRUE">Yes</option>
						<option value="FALSE">No</option>
					</select>
				</div>
				<div>
					<input type="submit" value="Save" class="btn btn-success">
				</div>
			</form>
		</section>
		<section>
			<div class="text-center">
				 <a href="<?php echo base_url('admin/create'); ?>" class="btn btn-success">Create New Post</a>
			</div>
			<hr />
			<h3 class="text-center">Posts Created by You</h3>
			<p></p>
			<?php
			if(!empty($posts)) {
			foreach($posts as $post) {
			$excerpt = substr(strip_tags($post->content),0,200);
			if($post->comments > 1) {
				$comment_text = "Comments";
			}
			else{
				$comment_text = "Comment";
			}
			$edate = strtotime($post->updated);
				$edate = date('d-m-Y h:i a', $edate);
			?>

				<div class="">
					<div class="pull-left">
						<h4><a href="<?php echo base_url().'post/index/'.$post->link; ?>" title="<?=$post->title; ?>"><?=$post->title; ?></a></h4>
						<p><?=$excerpt; ?></p>
						<p><span><?=$post->comments." ".$comment_text; ?></span> . <span><?=$edate; ?></span></p>
					</div>
					<div class="pull-right" style="margin-top: 15px;margin-right: 30px;">
						<a href="<?=base_url('admin/edit').'/'.$post->link; ?>" class="btn btn-primary">Edit</a> . <a href="<?=base_url('admin/remove').'/'.$post->link; ?>" class="btn btn-danger">Delete</a>
					</div>
				</div> 


		<?php	}
		}
		else{ ?>
			<div class="">You have not created any post yet! <a href="<?php echo base_url('admin/create'); ?>" class="btn btn-success">Create New Post</a> </div>
		<?php } ?>
		</section>
	</div>
</div>