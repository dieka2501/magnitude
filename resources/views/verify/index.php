<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>IndobuildTech Email Verification</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  padding-bottom: 19px;
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 28px;
}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
    </style>
    
</head>
<body>
<div class="container">
    <h1 class="we"><img src="<?php echo config('app.url') ?>public/img/logoindobuildtech.png">Please Verify Your Email</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<!-- <form method="POST" action=''> -->
					<div id='notip'></div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Email Address</label>
							<input type="email" placeholder="Enter Email Address Here.." class="form-control" name='email' id='email' value="" required> 
						</div>	
						<div class='row'>
							<div class='col-sm-6'>
								<button type="button" class="btn btn-lg btn-info" id="btn-submit">Submit</button>							
							</div>
							<!-- <div class='col-sm-6 text-right'>
								<button type="button" class="btn btn-lg btn-danger" id='btn-reset'>Reset</button>							
							</div> -->
						</div>
					
					</div>
				<!-- </form>  -->
				</div>
	</div>
	</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#btn-submit').click(function(){
			var email 		= $('#email').val();
			$.post('<?php echo config("app.url")?>public/verify/do',{
				'email' : email,
				'_token':'<?php echo csrf_token() ?>'

			},function(data){
				console.log(data);
				if(data.status){
					var htmlalert = "<div class='alert alert-success' role='alert'>"+data.alert+"</div>";
					$('#notip').html(htmlalert).show().fadeOut(3000);
					$('#email').val('');
				}else{
					var htmlalert = "<div class='alert alert-danger' role='alert'>"+data.alert+"</div>";
					$('#notip').html(htmlalert).show().fadeOut(3000);;
				}	
			});
		});

		$(this).ajaxStart(function(data){
			$('#btn-submit').html('Loading....');
		}).ajaxStop(function(data){
			$('#btn-submit').html('Submit');
		});
	});
</script>
</body>
</html>
