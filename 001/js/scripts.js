jQuery(document).ready(function($) {
    /**  TRABALHE CONOSCO FORM  **/	
    $("#trabalheConoscoForm .submit").click(function(e) { 
    	e.preventDefault();
        
        //get input field values
        var to_email        = $('input[name=to]').val(); 
        var user_name       = $('input[name=name]').val(); 
        var user_email      = $('input[name=email]').val();
        var user_phone      = $('input[name=telephone]').val();
        var user_message    = $('textarea[name=message]').val();
        var attach_file     = $('input[name=file_attach]')[0].files[0];
        
        //simple validation at client's end
        //we simply change border color to red if empty field using .css()
        var proceed = true;
        if(to_email==""){ 
            $('input[name=to]').css('border-color','red'); 
            proceed = false;
        }
        if(user_name==""){ 
            $('input[name=name]').css('border-color','red'); 
            proceed = false;
        }
        if(user_email==""){ 
            $('input[name=email]').css('border-color','red'); 
            proceed = false;
        }
        if(user_phone=="") {    
            $('input[name=telephone]').css('border-color','red'); 
            proceed = false;
        }
        if(user_message=="") {  
            $('textarea[name=message]').css('border-color','red'); 
            proceed = false;
        }

        //everything looks good! proceed...
        if(proceed) 
        {
            $('.loading').addClass('show');
            $("button.submit").hide();

            $('#mail-emulate').hide();

            // $(".loading-img").show(); //show loading image
            // $(".submit_btn").hide(); //hide submit button
            
            //data to be sent to server         
            var post_data = new FormData();    
            post_data.append( 'toEmail', to_email );
            post_data.append( 'userName', user_name );
            post_data.append( 'userEmail', user_email );
            post_data.append( 'userPhone', user_phone );
            post_data.append( 'userMessage',user_message);
            post_data.append( 'file_attach', attach_file );
            
            //instead of $.post() we are using $.ajax()
            //that's because $.ajax() has more options and can be used more flexibly.

            $.ajax({
                url: $("#trabalheConoscoForm").attr('action'),
                data: post_data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                success: function(data){
                    //load json data from server and output message     
                    if(data.type == 'error')
                    {
                        output = '<div class="error">'+data.text+'</div>';
                    }else{
                        output = '<div class="success">'+data.text+'</div>';
                        
                        //reset values in all input fields
                        $('#trabalheConoscoForm input').val(''); 
                        $('#trabalheConoscoForm textarea').val(''); 
                    }
                    
                    $("div.email-sent").html(output).addClass('show').slideDown();
                    //$("div.email-sent").hide().html(output).slideDown(); //show results from server
                    //$(".loading").hide(); //hide loading image
                    $(".loading").removeClass('show');
                    $("#trabalheConoscoForm .submit").show(); //show submit button
                    ///$('#trabalheConoscoForm').slideUp(2000);


                    // DEBUG                    
                    if( data.debug[3] ){
                        var anexo = data.debug[3];
                        $('#mail-emulate').hide();
                        $('#mail-emulate .panel-body').html( data.debug[3] );
                        $('#mail-emulate').show();
                    }
                    

                }
            });
        }
    });
    
    //reset previously set border colors and hide all message on .keyup()
    $("#trabalheConoscoForm input, #trabalheConoscoForm textarea").keyup(function() { 
        $("#trabalheConoscoForm input, #trabalheConoscoForm textarea").css('border-color',''); 
        $("div.email-sent").slideUp();
    });

    /**  end TRABALHE CONOSCO FORM  **/
        
});