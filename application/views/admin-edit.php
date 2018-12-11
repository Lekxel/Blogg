<div class="container-fluid">
	<h1 class="text-center">Update Post</h1>
	<p></p>
	<section class="container">
		<p></p>
		<br>
		<?php echo form_open(); ?>
			<div class="form-group">
				<label>Title</label>
				<input type="text" name="title" class="form-control" value="<?=$title; ?>">
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea name="content" class="form-control"><?=$content; ?></textarea>
			</div>
			<div>
				<input type="submit" name="edit_post" value="Update" class="btn btn-primary">
			</div>
		</form>
	</section>
</div>