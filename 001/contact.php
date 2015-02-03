<?php
#
#	Modificação do script [http://www.sanwebe.com/2014/04/ajax-contact-form-attachment-jquery-php]
#
if($_POST)
{
	if( "" != $_POST["toEmail"] ){
		$to_Email   = $_POST["toEmail"]; //Replace with recipient email address		
	}else{
		$to_Email   = "tonetlds@gmail.com"; //Replace with recipient email address		
	}

	$subject        = 'Novo currículo enviado pelo site'; //Subject line for emails
	$from_email		= 'no-reply@lucianotonet.com';
	
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	
		//exit script outputting json data
		$output = json_encode(
		array(
			'type'=>'error', 
			'text' => 'A requisicao deve ser feita via Ajax'
		));
		
		die($output);
    } 
	
	//check $_POST vars are set, exit if any missing
	if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["userPhone"]) || !isset($_POST["userMessage"]))
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Os campos estão vazios!'));
		die($output);
	}

	//Sanitize input data using PHP filter_var().
	$user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
	$user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
	$user_Phone       = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
	$user_Message     = filter_var($_POST["userMessage"], FILTER_SANITIZE_STRING);
	
	//additional php validation
	if(strlen($user_Name)<4) // If length is less than 4 it will throw an HTTP error.
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Ei! '.ucfirst($user_Name).' é mesmo seu nome?'));
		die($output);
	}
	if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Digite um e-mail válido!'));
		die($output);
	}
	if(!is_numeric($user_Phone)) //check entered data is numbers
	{
		$output = json_encode(array('type'=>'error', 'text' => 'O telefone precisa ser somente números.'));
		die($output);
	}
	if(strlen($user_Message)<5) //check emtpy message
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Mensagem muito curta. Escreva alguma coisa.'));
		die($output);
	}
	
	### Attachment Preparation ###
	$file_attached = false; //initially file is not attached
	
	if(isset($_FILES['file_attach'])) //check uploaded file
	{
		//get file details we need
		$file_tmp_name 	  = $_FILES['file_attach']['tmp_name'];
		$file_name 		  = $_FILES['file_attach']['name'];
		$file_size 		  = $_FILES['file_attach']['size'];
		$file_type 		  = $_FILES['file_attach']['type'];
		$file_error 	  = $_FILES['file_attach']['error'];
		
		//exit script and output error if we encounter any
		if($file_error>0)
		{
			$mymsg = array( 

			1=>"Erro! O anexo enviado excede o limite de ".ini_get('upload_max_filesize')." permitido pelo servidor.", 
			2=>"Erro! O anexo enviado excede o limite de tamanho permitido.", 
			3=>"Erro! O anexo foi parcialmente enviado. Tente novamente.", 
			4=>"Erro! Nenhum arquivo foi enviado", 
			6=>"Erro! Não existe pasta temporária no servidor." ); 
			
			$output = json_encode(array('type'=>'error', 'text' => $mymsg[$file_error]));
			die($output); 
		}
	
		//read from the uploaded file & base64_encode content for the mail
		$handle = fopen($file_tmp_name, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$encoded_content = chunk_split(base64_encode($content));
		
		//now we know we have the file for attachment, set $file_attached to true
		$file_attached = true;
	}

	if($file_attached) //continue if we have the file
	{
		# Mail headers should work with most clients (including thunderbird)
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "X-Mailer: PHP/" . phpversion()."\r\n";
		$headers .= "From: ".$from_email."\r\n";
		$headers .= "Subject:".$subject."\r\n";
		$headers .= "Reply-To: ".$user_Email."" . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=".md5('boundary1')."\r\n\r\n";
	
		$headers .= "--".md5('boundary1')."\r\n";
		$headers .= "Content-Type: multipart/alternative;  boundary=".md5('boundary2')."\r\n\r\n";
		
		$headers .= "--".md5('boundary2')."\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n\r\n";

			$body  = "<p><strong>Nome: </strong><br />".$user_Name."</p>\r\n";
			$body .= "<p><strong>Telefone: </strong><br />".$user_Phone."</p>\r\n";
			$body .= "<p><strong>E-mail: </strong><br />".$user_Email."</p>\r\n";
			$body .= "<p><strong>Mensagem: </strong><br />".$user_Message."</p>\r\n";
			$body .= "&nbsp;<p><small>Currículo em anexo.</small></p>\r\n";
		
		$headers .= $body."\r\n\r\n";
	
		$headers .= "--".md5('boundary2')."--\r\n";
		$headers .= "--".md5('boundary1')."\r\n";
		$headers .= "Content-Type:  ".$file_type."; ";
		$headers .= "name=\"".$file_name."\"\r\n";
		$headers .= "Content-Transfer-Encoding:base64\r\n";
		$headers .= "Content-Disposition:attachment; ";
		$headers .= "filename=\"".$file_name."\"\r\n";
		$headers .= "X-Attachment-Id:".rand(1000,9000)."\r\n\r\n";
		$headers .= $encoded_content."\r\n";
		$headers .= "--".md5('boundary1')."--";	
	}else{
		# Mail headers for plain text mail
		$headers = 'From: '.$from_email.'' . "\r\n" .
		'Reply-To: '.$user_Email.'' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	}	

	//send the mail
	$sentMail = @mail($to_Email, $subject, $body, $headers);	

	$debug = array( $to_Email , $subject, $body, $headers );
	
	if(!$sentMail) //output success or failure messages
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Não foi possível enviar o e-mail. Por favor, contate o serviço de hospedagem.', 'debug' => $debug ));
		die($output);
	}else{
		$output = json_encode( array('type'=>'message', 'text' => 'Obrigado, '.$user_Name .'. Analisaremos seu pedido e entraremos em contato.', 'debug' => $debug ));
		die($output);
	}
}