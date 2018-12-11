<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $pageTitle; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="UTF-8" />
 <!--	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" />
<script src="<?php echo base_url(); ?>assets/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo base_url(); ?>assets/fontawesome/css/all.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Shrikhand' rel='stylesheet'>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css" />
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" href="<?=base_url(); ?>"><?=$site_name; ?></a>
	    </div>
	    <div class="container collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-center">
	        <li class="active"><a href="<?=base_url(); ?>">Home</a></li>
	        <li><a href="#">About</a></li>
	        <li><a href="#">Contact</a></li>
	        <li><a href="#">Privacy</a></li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?php echo base_url('admin/login'); ?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>