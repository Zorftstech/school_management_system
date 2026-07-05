$(document).ready(function(){
    

    $('#submit').click(function(event){

        event.preventDefault();
        
        var surname = $('#surname').val();
        var first_name = $('#first').val();
        var other_name = $('#other').val();
        var birth = $('#birth').val();
        var gender = $('#gender').val();
        var address = $('#address').val();
        var country = $('#country').val();
        var age = $('#age').val();
        var state = $('#state').val();
        var local = $('#local').val();
        var old = $('#old').val();
        var start = $('#start').val();
        var disability = $('#disability').val();
        var health = $('#health').val();
        var session = $('#session').val();
        var f_surname = $('#f_surname').val();
        var f_first = $('#f_first').val();
        var f_other = $('#f_other').val();
        var f_phone = $('#f_phone').val();
        var f_email = $('#f_email').val();
        var f_address = $('#f_address').val();
        var m_surname = $('#m_surname').val();
        var m_first = $('#m_first').val();
        var m_other = $('#m_other').val();
        var m_phone = $('#m_phone').val();
        var m_email = $('#m_email').val();
        var m_address = $('#m_address').val();

        function error_load(data, id){

            $(data).text('fill this field');
           $(id).css('border-color', 'tomato');
           alert('please fill all the required field')

           setTimeout(function(){
               
            $(data).text('');
            $(id).css('border-color', '#444');
           }, 15000);
        }

        if (surname == '') {

            error_load('#surname_error', '#surname');
            
        }else{

            if(first_name == ''){

                error_load('#first_error', '#first');
            }else{

                if (birth == '') {

                    error_load('#birth_error', '#birth');
                }else{

                    if (gender == '') {
                        
                        error_load('#gender_error', '#gender');
                    }else{

                        if (address == '') {
                            
                            error_load('#address_error', '#address');
                        }else{

                            if (country == '') {
                                
                                error_load('#country_error', '#country');
                            }else{

                                if (age == '') {
                                    
                                    error_load('#age_error', '#age');
                                }else{

                                    if (state == '') {
                                        
                                        error_load('#state_error', '#state');
                                    }else{

                                        if (local == '') {
                                            
                                            error_load('#local_error', '#local');

                                        }else{

                                            if (old == '') {
                                                
                                                error_load('#old_error', '#old');
                                            }else{

                                                if (start == '') {
                                                    
                                                    error_load('#start_error', '#start');
                                                }else{

                                                    if (disability == '') {
                                                        
                                                        error_load('#disability_error', '#disability');
                                                    }else{

                                                        if (health == '') {
                                                            
                                                            error_load('#health_error', '#health');
                                                        }else{

                                                            if (session == '') {
                                                                
                                                                error_load('#session_error', '#session');
                                                            }else{

                                                                if (f_surname == '') {
                                                                    
                                                                    error_load('#f_surname_error', '#f_surname');
                                                                }else{
                                                                    if (f_first == '') {
                                                                        
                                                                        error_load('#f_first_error', '#f_first');
                                                                    }else{
                                                                        if (f_phone == '') {
                                                                            
                                                                            error_load('#f_phone_error', '#f_phone');
                                                                        }else{
                                                                            if (f_email == '') {
                                                                              
                                                                                error_load('#f_email_error', '#f_email');
                                                                            }else{
                                                                                if (f_address == '') {
                                                                                    
                                                                                    error_load('#f_address_error', '#f_address');
                                                                                }else{

                                                                                    if (m_surname == '') {
                                                                    
                                                                                        error_load('#m_surname_error', '#m_surname');
                                                                                    }else{
                                                                                        if (m_first == '') {
                                                                                            
                                                                                            error_load('#m_first_error', '#m_first');
                                                                                        }else{
                                                                                            if (m_phone == '') {
                                                                                                
                                                                                                error_load('#m_phone_error', '#m_phone');
                                                                                            }else{
                                                                                                if (m_email == '') {
                                                                                                  
                                                                                                    error_load('#m_email_error', '#m_email');
                                                                                                }else{
                                                                                                    if (m_address == '') {
                                                                                                        
                                                                                                        error_load('#m_address_error', '#m_address');
                                                                                                    }else{

                                                                                                        var reg = /^([0-9]{4})\/([0-9]{4})$/;
                                                                                                        var correct = reg.test(session);
                                                                                                        if (!correct) {
                                                                                                            alert('session is incorrect');
                                                                                                            $('#session_error').text('data format 2011/2021');
                                                                                                            $('#session').css('border-color', 'tomato');

                                                                                                            setTimeout(function(){
                                                                                                                $('#session_error').text('');
                                                                                                                $('#session').css('border-color', '#444');
                                                                                                            }, 15000);

                                                                                                        }else{

                                                                                                            var reg_two = /^([0-9]{11})$/;
                                                                                                            var correct_two = reg_two.test(f_phone);
                                                                                                            if(!correct_two){

                                                                                                                alert('father number is incorrect');
                                                                                                                $('#f_phone_error').text('number must be 11 digit');
                                                                                                                $('#f_phone').css('border-color', 'tomato');

                                                                                                                setTimeout(function(){
                                                                                                                $('#f_phone_error').text('');
                                                                                                                $('#f_phone').css('border-color', '#444');
                                                                                                                }, 15000);

                                                                                                            }else{
                                                                                                                
                                                                                                                var reg_tre =  /^([0-9]{11})$/;
                                                                                                                var correct_tre = reg_tre.test(m_phone);

                                                                                                                if (!correct_tre) {
                                                                                                                    
                                                                                                                    alert('mother number is incorrect');
                                                                                                                    $('#m_phone_error').text('number must be 11 digit');
                                                                                                                    $('#m_phone').css('border-color', 'tomato');

                                                                                                                    setTimeout(function(){
                                                                                                                    $('#m_phone_error').text('');
                                                                                                                    $('#m_phone').css('border-color', '#444');
                                                                                                                    }, 15000);

                                                                                                                }else{

                                                                                                                    $.ajax({
                                                                                                                        url: 'action_php/student_registration_form_action.php',
                                                                                                                        data: $('#form').serialize(),
                                                                                                                        method: 'POST',
                                                                                                                        dataType: 'text',
                                                                                                                        beforeSend: function(){
                                                                                                                            $('#submit').attr('disabled', 'disabled');
                                                                                                                            $('#submit').val('submiting.....');
                                                                                                                        },
                                                                                                                        
                                                                                                                        success: function(data) {
                                                                                                                            alert(data);
                                                                                                                        }
                                                                                                                    });
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
       
        //if (surname == '' || first_name == '' || birth == '' || gender == '' || address == '' || country == '' || age == '' || state == '' || local == '' || old == '' || start == '' || disability == '' || health == '' || session == '' || f_surname == '' || f_first == '' || f_phone == '' || f_email == '' || f_address == '' || m_surname == '' || m_first == ''  ||  m_phone == '' || m_email == '' || m_address == '') {

            //alert('emptyoooooooooo');
            
        //}else{

            var reg = /^([0-9]{4})\/([0-9]{4})$/;
            var correct = reg.test(session);
            if (correct) {
                
               
            }else{
                
            }
        //}
    })













})