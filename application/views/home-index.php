<div class="container">
	<h1 class="text-center page-header">Welcome To Blogg v1.0</h1>
	<p></p>
	<?php if(!empty($this->session->flashdata('success_alert'))) {
		echo '<div class="alert alert-success alert-dismissible"><button class="close" data-dismiss="alert">&times;</button>'.$this->session->flashdata('success_alert').'</div><br>';
	} ?>
	<div class="row">
		<section class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			<h2 class="text-center">Latest Articles</h2>
			<p></p>
			<?php

			if(!empty($posts)) {
				foreach($posts as $post) {
				$excerpt = substr(strip_tags($post->content),0,300);
				//Get Thumbnail
				$first_img = '';
				$matches = array();
				$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->content, $matches);

			    if(empty($matches [1] [0])){ //Defines a default image
			        $first_img = base_url()."assets/no_image.png";
			    }
			    else{
			    	$first_img = $matches [1] [0];
			    }
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
							<h3 class="h2"><a href="<?php echo base_url().'post/index/'.$post->link; ?>" title="<?=$post->title; ?>"><?=$post->title; ?></a></h3>
							<p><?=$excerpt; ?>...</p>
							<p><span><?=$post->author; ?></span> . <span><?=$post->comments." ".$comment_text; ?></span> . <span><?=$edate; ?></span></p>
						</div>
						<div class="pull-right img-responsive">
							<img src="<?=$first_img; ?>" class="thumbnail" style="width:120px;height:120px;" alt="<?=$post->title; ?>" />
						</div>
						<div class="clearfix"></div>
					</div>
					<hr /> 


			<?php	}
			}
			else{ ?>
				<div class="">No Posts Yet! </div>
			<?php } ?>
			<hr />
		</section>
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