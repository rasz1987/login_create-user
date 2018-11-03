<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo uri_string(); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css')?>">
	<!--BOOTSTRAP-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!--BOOTSTRAP-->
	
</head>
<body>

<div id="container">
	<h1 style="font-size: 6vw" >Welcome to Login Project!</h1>

	<div id="body">
		<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
		<?php echo $this->session->flashdata('success'); ?>
		<form>
			<div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
		    	<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
		    	<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
			</div>
			<div class="form-group">
		    	<label for="exampleInputPassword1">Password</label>
		    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
			</div>
			<div class="form-group form-check">
		    	<input type="checkbox" class="form-check-input" id="exampleCheck1">
		    	<label class="form-check-label" for="exampleCheck1">Check me out</label>
		    </div>
			<div class="form-group">
		    	<a href="#">Password recovery</a> | <a href="#exampleModalCenter" data-toggle="modal" >Create User</a>
			</div>
			<button type="submit" class="btn btn-primary">Login</button>
		</form>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php /*echo*/  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Create User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	
        <form action="<?php echo base_url('save'); ?>" method="post">
			<div class="form-group">
				<label for="name">Name & Lastname:</label>
		    	<input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name')?>" aria-describedby="nameHelp" placeholder="Enter your name" maxlength= "150" >
		    </div>
			<div class="form-group">
		    	<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo set_value('lastname')?>" placeholder="Enter your lastname" maxlength= "150" >
			</div>
			<div class="form-group">
		    	<label for="email">Email & User:</label>
		    	<input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email')?>" placeholder="Enter your email" maxlength= "150" >
			</div>
			<div class="form-group">
		    	<input type="text" class="form-control" id="user" name="user" value="<?php echo set_value('user')?>" placeholder="Enter your user" maxlength= "150" >
			</div>
			<div class="form-group">
		    	<label for="password">Password:</label>
		    	<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" maxlength="150" >
			</div>
			<div class="form-group">
		    	<input type="password" class="form-control" id="passconf" name="passconf" placeholder="Retype your password" maxlength="150" >
			</div>
			<hr>
			<div>
				<h5 class="modal-tittle">Questions to recovery password</h5>
			</div>
			<?php
			//Declaration of variables for dropdown
			$opt_q = array_combine(
				array_column($questions, 'id'), 
				array_column($questions, 'preguntas')
			);
			?>
			<div class="form-group">
		    	<label for="email">First question:</label>
		    	<?php echo form_dropdown('firstQ',$opt_q,'','class="form-control"');?>
		    </div>
			<div class="form-group">
		    	<input type="text" class="form-control" id="firstA" name="firstA" value="<?php echo set_value('firstA')?>" placeholder="Enter your first answer" maxlength= "250" >
			</div>

			<div class="form-group">
		    	<label for="email">Second question:</label>
		    	<?php echo form_dropdown('secondQ',$opt_q,'','class="form-control"'); ?>
			</div>
			<div class="form-group">
		    	<input type="text" class="form-control" id="secondA" name="secondA" value="<?php echo set_value('secondA')?>" placeholder="Enter your second answer" maxlength= "250" >
			</div>
	  </div>
      <div class="modal-footer">
        <button type="submit" name="save" class="btn btn-success">Save changes</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>