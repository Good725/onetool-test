<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo site_url('assets/css/main.css');?>">
        <script src='https://www.google.com/recaptcha/api.js'></script>

	</head>
	<body>
		<div class="container" id="main">    
		    <div style="margin-top:80px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
		        <div class="panel panel-primary">
		            <div class="panel-heading">
		                <div class="panel-title">Sign Up</div>
		            </div>  
		            <div class="panel-body" >
		                <form method="post" action="<?=base_url()?>user/register" class="form-horizontal" role="form" enctype="multipart/form-data">
		                	<?php
				                if ($this->session->flashdata('message'))
				                {
				                ?>
				                    <div class="alert alert-danger">
				                        <?php
				                        echo $this->session->flashdata('message');
				                        ?>
				                    </div>
				                <?php
				                }

				                if ($this->session->flashdata('success_message'))
				                {
				                ?>
				                    <div class="alert alert-success">
				                        <?php
				                        echo $this->session->flashdata('success_message');
				                        ?>
				                    </div>
				                <?php
				                }
			                ?>

		                    <div class="form-group">
		                        <label for="username" class="col-md-3 control-label">Username</label>
		                        <div class="col-md-9">
		                            <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="<?php echo $this->input->post('username');?>">
		                            <div class="alert-danger"><?php echo form_error('username'); ?></div>
		                        </div>
		                    </div>

		                    <div class="form-group">
		                        <label for="email" class="col-md-3 control-label">Email</label>
		                        <div class="col-md-9">
		                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $this->input->post('email');?>">
		                            <div class="alert-danger"><?php echo form_error('email'); ?></div>
		                        </div>
		                    </div>

		                    <div class="form-group">
		                        <div class="g-recaptcha recaptcha" id="g-recaptcha" data-sitekey="6Le7nYMaAAAAAJHiQDi9zUUh7-a5N13JkKNbFvHw"></div>
		                    </div>

		                    <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
		                        <div class="col-md-offset-3 col-md-9">
		                            <input type="submit" class="btn btn-primary" value=" &nbsp Sign Up &nbsp">
		                        </div>                                           
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div> 
		</div>
	</body>
</html>