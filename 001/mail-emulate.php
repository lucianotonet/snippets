<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ajax Form With File Upload</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<style>
			
		</style>
	</head>
	<body>
		<div class="row">
			<div class="container">	
				
				<div class="panel panel-success">
					
					<div class="panel-body">
						
						<strong>From:</strong>
						<pre><?php print_r($from_email) ?></pre>

						<br>

						<strong>To:</strong>
						<pre><?php print_r($to_Email) ?></pre>
	
						<br>

						<strong>Body:</strong>
						<pre><?php print_r($body) ?></pre>

						<br>

						<strong>Headers:</strong>
						<pre><?php print_r($headers) ?></pre>

						<br>

					</div>
					
				</div>

			</div>
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

	</body>
</html>