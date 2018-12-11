<div class="container">
	<h1 class="text-center page-header"><?=$title; ?></h1>
	<p></p>
	<?php if(!empty(validation_errors())) {
		echo '<div class="alert alert-danger alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.validation_errors().'</div><br>';
	} ?>
	<div class="row">
		<section class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<?php
			if($comments_num > 1) {
					$comment_text = "Comments";
			}
			else{
					$comment_text = "Comment";
			} ?>
			<p><span><?=$updated; ?></span> . <span><?=$comments_num. ' '.$comment_text; ?></span></p>
			<br>
			<p><?=$content; ?></p>
			<br>
			<p>Posted by <b><?=$author; ?></b></p>
			<hr />
			
			<!--Comment Section -->
			<?php
			if($allow_comment == "TRUE") { ?>
				<h2 class="text-center">Post Comment</h2>
				<form method="POST" action="<?=base_url('post/comment'); ?>">
					<div class="form-group">
						<label for="name">Your Name</label>
						<input type="text" name="name" placeholder="Enter your name" class="form-control">
					</div>
					<div class="form-group">
						<label for="comment_body">Comment</label>
						<textarea name="comment_body" class="form-control" placeholder="Your Comment"></textarea>
					</div>
					<input name="post_id" value="<?=$post_id; ?>" hidden>
					<input type="submit" class="btn btn-lg btn-success">
				</form>
			<?php } ?>
			<p></p>
			<h2 class="text-center">Comments</h2>
			<?php
			if(!empty($comments)) {
				foreach ($comments as $comment) {
					$edate = strtotime($comment->created);
					$edate = date('d-m-Y h:i a', $edate);
					?>

					<div>
						<p>Posted by <b><?=$comment->author; ?></b> on <?=$edate; ?></p>
						<br>
						<p><?=$comment->content; ?></p>
					</div>
					<hr />
				<?php }
			}
			else{ ?>
				<div class="well">
					<p class="lead">No Comments yet!</p>
					</div> 
			<?php } ?>
		</section>
		<hr/>
		<section class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<h2>Links</h2>
			<ul>
				<li><a href="about">About</a></li>
				<li><a href="contact">Contact</a></li>
				<li><a href="privacy">Privacy Policy</a></li>
			</ul>
		</section>
	</div>
</div>