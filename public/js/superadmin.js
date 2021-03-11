$('#guardar').on('click',function(){
    if($('#password').val() && $('#password_old').val() && $('#password_old_two').val()){
        console.log('lleno');
        let password = $('#password').val();
        let password_old = $('#password_old').val();
        let password_old_two = $('#password_old_two').val();
        if(password_old == password_old_two){
            $.post('/superadmin/password',{password,password_old,password_old_two,_token:$("meta[name='csrf-token']").attr("content")},function(res){
                console.log(res.status);
                if(res.status == 200){
                    console.log("contraseña cambiada");
                    $('#password').css("border-color", "#4CAF50")
                    $('#password_old').css("border-color", "#4CAF50")
                    $('#password_old_two').css("border-color", "#4CAF50")
                    $('.message-file').empty().append(
                        `<div class="notification success closeable">
                            <p> <i class="im im-icon-Over-Time2"></i>Contraseña modificada con exito</p>
                                            
                        </div>`); 
                }
                else{
                    console.log("contraseña no cambiada");
                    $('#password').css("border-color", "#FA3B3B");
                    $('.message-file').empty().append(
                        `<div class="notification error closeable">
                            <p> <i class="im im-icon-Over-Time2"></i>Contraseña incorrecta.</p>
                                            
                        </div>`);
                }
            }) 
        }
        else{
            $('.message-file').empty().append(
                `<div class="notification error closeable">
                    <p> <i class="im im-icon-Over-Time2"></i>Las contraseñas no son idénticas</p>
                                    
                </div>`);
                $('#password_old').css("border-color", "#FA3B3B");
                $('#password_old_two').css("border-color", "#FA3B3B");
        }
        
    }
    else{
        $('#password').val() != "" ? $('#password').css("border-color", "#4CAF50"):$('#password').css("border-color", "#FA3B3B");
        $('#password_old').val() != "" ? $('#password_old').css("border-color", "#4CAF50"):$('#password_old').css("border-color", "#FA3B3B");
        $('#password_old_two').val() != "" ? $('#password_old_two').css("border-color", "#4CAF50"):$('#password_old_two').css("border-color", "#FA3B3B");
        
    }
})
