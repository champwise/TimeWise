$(document).ready(function(){   

    // ajax function to check if username exists
    function usernameCheck(username){


        $.ajax({
            type: 'POST',
            url: "scripts/php/usernamecheck.php",
            data: 'username=' + username,
            cache: false,
            success: function(data) {
                
                if(data == 0){
                    $('#usernamecheck').html(" Username is available");
                    $('#usernamecheck').css('color', 'green');
                }
                else{
                    $('#usernamecheck').html(" Username is unavailable");
                    $('#usernamecheck').css('color', 'red');
                    
                }
            }
            
        });
    }

    // function to check if passwords match
    function passwordsMatch(password1, password2){

        if(password1 == password2){

            $('#passwordcheck').html('');
        }
        else{
            $('#passwordcheck').html(' Passwords do not match');
            $('#passwordcheck').css('color', 'red');
        }

    }

    // function that won't let form be submitted unless its's filled out correctly
    function formCheck(){

        if($('#usernamecheck').html() == " Username is available" && $('#passwordcheck').html() == '' &&  $('#password').val() != ''){
            $('#register').attr('type', 'submit');
        }

        else{
            $('#register').attr('type', 'button');
        }
    }

    // event listener for key up in the username field
    $(document).on('keyup', '#username' , function(){
        usernameCheck($(this).val());
        formCheck();

    });

    // event listener for key up in the password field
    $(document).on('keyup', '#password' , function(){
        passwordsMatch($(this).val(), $('#password2').val());
        formCheck();

    });

    // event listener for key up in the second password field
    $(document).on('keyup', '#password2' , function(){
        passwordsMatch($(this).val(), $('#password').val());
        formCheck();

    });



}); 