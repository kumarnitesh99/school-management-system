$(document).ready(function(){ 
    $('input,select').css('box-shadow','none');
    $('#error, #success,.success-message').css('display','none');
    $('#close').on('click',function(){
        $('#managementForm').trigger('reset');
    });

    $("#fname").blur(function(){
        check_name('fname','first name',$('#fname').val());
    });
    $("#lname").blur(function(){
        check_name('lname','last name',$('#lname').val());
    });
    $("#email").blur(function(){
        check_email('email','email',$('#email').val());
    });
    $("#phone").blur(function(){
        check_phone('phone','phone number',$('#phone').val());
    });
    $("#password").focus(function(){
        check_select('select','type of user',$('#select').val());
    });
    $("#password").blur(function(){
        check_password('password','password',$('#password').val());
    });
    function check_name(id,msg,name){
        var pattern = /^[a-zA-Z]*$/;
        if(name == ''){
            $('#'+id+"_error_message").text("Please enter "+msg);
            $('#'+id).css('border','1px solid red');
            return false;
        }else{
            if(!pattern.test(name)){
                $('#'+id+"_error_message").text("Please valid "+msg);
                $('#'+id).css('border','1px solid red');
                return false;
            }else{
                $('#'+id+"_error_message").text("");
                $('#'+id).css('border','');
                return true;
            }
        }
    }  
    function check_email(id, msg, email){
        var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
        if(email == ''){
            $("#"+id+"_error_message").text("Please enter "+msg);
            $("#"+id).css("border","1px solid red"); 
            return false;
        }else{
            if(!pattern.test(email)){
                $("#"+id+"_error_message").text("Please enter valid "+msg);
                $("#"+id).css("border","1px solid red"); 
                return false;
            }else{
                $("#"+id+"_error_message").text("");
                $("#"+id).css("border","");
                return true;
            }  
        }
    }
    function check_phone(id, msg, phone){
        var pattern = /^\d{10}$/;
        if(phone == ''){
            $("#"+id+"_error_message").text("Please enter "+msg);
            $("#"+id).css('border','1px solid red');
            return false;
        }else{
            if(!pattern.test(phone)){
                $("#"+id+"_error_message").text("Please enter only 10 digits");
                $("#"+id).css('border','1px solid red');
                return false;
            }else{
                $("#"+id+"_error_message").text("");
                $("#"+id).css('border','');
                return true;   
            }
        }
    }
    function check_select(id, msg, select){
        if(select == ""){
            $("#"+id+"_error_message").text("Please select valid "+msg);
            $("#"+id).css("border","1px solid red");
            return false; 
        }else{
            $("#"+id+"_error_message").text("");
            $("#"+id).css("border","");
            return true; 
        }
    }
    function check_password(id, msg, password){
        var pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        if(password == ""){
            $("#"+id+"_error_message").text("Please enter "+msg);
            $("#"+id).css("border","1px solid red");
            return false; 
        }else{
            if(!pattern.test(password)){
                $("#"+id+"_error_message").html("<ul><li>At least 8 characters</li><li>At least on digit</li><li>At least one uppercase and lowercase alphabet</li><li>At least one special character </li></ul>");
                $("#"+id).css("border","1px solid red");
                return false; 
            }else{
                $("#"+id+"_error_message").text("");
                $("#"+id).css("border","");
                return true; 
            }
        }
    }      
    
    $('#registration_form').on('submit',function(e){
        e.preventDefault();
        let fName = check_name('fname','first name',$('#fname').val());
        let lName = check_name('lname','last name',$('#lname').val());
        let email = check_email('email','email',$('#email').val());
        let phone = check_phone('phone','phone number',$('#phone').val());
        let select = check_select('select','type of user',$('#select').val());
        let password = check_password('password','password',$('#password').val());

        if((fName != null) && (lName != null) && (email != null) && (phone != null) && (select != "") && (password != null)){
            $.ajax({
                url: "registeration.php",
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#register').val('validate.....');
                    $('#register').attr('disabled','disabled');
                },
                success: function(data){
                    if(data.success) {
                        $('#registration_form').trigger('reset');
                        $('#register').val('Register');
                        $('#register').attr('disabled',false);
                        $('#success').text(data.msg).fadeIn().fadeOut(3000);
                    }
                    if(data.error){
                        $('#register').val('Register');
                        $('#register').attr('disabled',false);
                        $('#error').text(data.msg).fadeIn().fadeOut(3000);
                    }
                }
            });
        }else{
            $('#error').text("All fields are required.").fadeIn().fadeOut(3000);
        }
        
    });


    $('#addForm').on('submit',function(e){
        e.preventDefault();
        let fName = check_name('fname','first name',$('#fname').val());
        let lName = check_name('lname','last name',$('#lname').val());
        let email = check_email('email','email',$('#email').val());
        let phone = check_phone('phone','phone number',$('#phone').val());
        let select = check_select('select','type of user',$('#select').val());
        let password = check_password('password','password',$('#password').val());

        if((fName != null) && (lName != null) && (email != null) && (phone != null) && (select != "") && (password != null)){
            $.ajax({
                url: "registeration.php",
                method: "POST",
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#addbtn').val('validate.....');
                    $('#addbtn').attr('disabled','disabled');
                },
                success: function(data){
                    if(data.success) {
                        $('#addForm').trigger('reset');
                        $('#addbtn').val('Register');
                        $('#addbtn').attr('disabled',false);
                        $('#success').text(data.msg).fadeIn().fadeOut(3000);
                    }
                    if(data.error){
                        $('#addbtn').val('Register');
                        $('#addbtn').attr('disabled',false);
                        $('#error').text(data.msg).fadeIn().fadeOut(3000);
                    }
                }
            });
        }else{
            $('#error').text("All fields are required.").fadeIn().fadeOut(3000);
        }
        
    });
    
    
});

