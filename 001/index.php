<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ajax Form With File Upload</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		
		<div class="container">			
			<div class="well well-lg">
		
				<section class="contact-form">
		        	<h4>FORMULÁRIO</h4>
		            <form role="form" action="contact.php" method="post" id="trabalheConoscoForm">
		            	
		            	<!-- TO E-MAIL / DEMO ONLY -->
		            	<div class="form-group email">
							<input type="text" class="form-control" placeholder="Para" name="to">
						</div>
						<!-- TO E-MAIL / DEMO ONLY -->

						<div class="form-group name">
							<input type="text" class="form-control" placeholder="Nome" name="name">
						</div>
						<div class="form-group email">
							<input type="email" class="form-control" placeholder="E-mail" name="email">
						</div>
						<div class="form-group telephone">
							<input type="text" class="form-control" placeholder="Telefone" name="telephone">
						</div>
						<div class="form-group message">
							<textarea class="form-control" rows="3" placeholder="Mensagem" name="message"></textarea>
						</div>
		                <div class="form-group file ">
		                    <input type="file" class="form-control" name="file_attach" id="file"  title="Anexar Curriculum Vitae" data-filename-placement="inside">
		                    <!-- <div class="labelFile">Anexar Curriculum Vitae</div>
		                    <input type="file" class="form-control" name="file_attach" id="file"> -->

		                    <!-- <div class="fileUpload btn btn-primary">
		                        <span>Upload</span>
		                        <input type="file" class="upload" />
		                    </div> -->
		                    
		                    <span class="description">Anexos até 2Mb / Formatos: DOC, XLS, PDF, JPG, PNG, GIF.</span>
		                </div>

		                <!-- <div class="form-group file ">
		                    <span></span>
		                    <div class="form-control">
		                        <div class="fileUpload">
		                            <span class="button">Anexar Curriculum Vitae</span>
		                            <input type="file" class="upload btn btn-default" />
		                        </div>
		                    </div> 
		                    <span>Anexos até 2Mb / Formatos: DOC, XLS, PDF, JPG, PNG, GIF.</span>                       
		                </div> -->
		                <div class="loading">
		                    <img src="images/ajax-loader.gif">
		                </div>
		                <div class="error-info">
		                	Por favor, preencha os campos corretamente.
		                </div>
						<button type="submit" class="submit btn btn-default">Enviar</button>
					</form>
		            <div class="email-sent">
		            	Your email has been sent. <br>
						Thank you for using our contact form.
		            </div>
		        </section>



			</div>
		        
		    <div class="panel panel-success" id="mail-emulate">		    	
				<div class="panel-heading">
					<h3 class="panel-title">E-mail debug</h3>
				</div>
				<div class="panel-body">
					
				</div>		    			        				

		    </div>
	
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


		<!-- Custom scripts -->
		<script src="js/scripts.js"></script>

	</body>
</html>