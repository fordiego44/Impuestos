const auth_repartidor = {
    async signIn() {
        const credentials = {
            email: $('#email').val(),
            password: $('#password').val(),
        }
        const success = `<div class="notification closeable success" style=" margin-bottom: 5px;">
                            <p><span>Exito!</span>Ah Iniciado sesion correctamente.</p>
                        </div>`
        const process = `<div class="notification closeable notice" style = " margin-bottom: 5px;" >
                            <p><span>Enviando!</span> Informacion, Por favor espere...</p>
                        </div>`
        const error = `<div class="notification closeable error" style=" margin-bottom: 5px;">
                            <p><span>Error!</span> A ocurrido un error.</p>
                        </div>`
        $('#register-repartidor-result').empty().append(process);

        const { status, data: data } = await axios.post('/login-repartidor', credentials);
        setTimeout(function () {

            if (data.errors) {
                if (data.errors.password) {
                    document.getElementById('error-password').innerHTML = data.errors.password;
                    $("#password").css("border", '1px solid #ec2a2a');
                    $(".password").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-password').innerHTML = '';
                    $("#password").css("border", '1px solid #4caf50');
                    $(".password").css("color", '#4caf50');
                    state = false;
                }
                if (data.errors.email) {
                    document.getElementById('error-email').innerHTML = data.errors.email;
                    $("#email").css("border", '1px solid #ec2a2a');
                    $(".email").css("color", '#ec2a2a');
                    state = true;
                } else {

                    if (data.errors.email_register) {
                        document.getElementById('error-email').innerHTML = data.errors.email_register;
                        $("#email").css("border", '1px solid #ec2a2a');
                        $(".email").css("color", '#ec2a2a');
                        state = true;
                    } else {
                        document.getElementById('error-email').innerHTML = '';
                        $("#email").css("border", '1px solid #4caf50');
                        $(".email").css("color", '#4caf50');
                        state = false;
                    }/*
                document.getElementById('error-email').innerHTML = '';
                $("#email").css("border", '1px solid #4caf50');
                $(".email").css("color", '#4caf50');
                state = false;*/
                }

            }
            if (data.status == 200) {
                $('#register-repartidor-result').empty().append(success);

                $("#password").css("border", '1px solid #4caf50');
                $(".password").css("color", '#4caf50');
                $("#email").css("border", '1px solid #4caf50');
                $(".email").css("color", '#4caf50');
                document.getElementById('error-email').innerHTML = '';
                document.getElementById('error-password').innerHTML = '';

                return document.location.pathname = '/admin/repartidor/mis-pedidos';

            } else {
                $('#register-repartidor-result').empty().append(error);
            }
        }, 1000);

    },
    async signUp() {
        try {
            const credentials = {
                names: $('#names2').val(),
                email: $('#email2').val(),
                password: $('#password2').val(),
                password_confirmation: $('#password_confirmation2').val(),
            }
            let state = true;
            const { status, data: data } = await axios.post('/register-repartidor', credentials)
            if (data.errors) {
                if (data.errors.names) {
                    document.getElementById('error-names2').innerHTML = data.errors.names;
                    $("#names2").css("border", '1px solid #ec2a2a');
                    $(".names2").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-names2').innerHTML = ''
                    $("#names2").css("border", '1px solid #4caf50');
                    $(".names2").css("color", '#4caf50');
                    state = false;
                }
                if (data.errors.email) {
                    document.getElementById('error-email2').innerHTML = data.errors.email;
                    $("#email2").css("border", '1px solid #ec2a2a');
                    $(".email2").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-email2').innerHTML = '';
                    $("#email2").css("border", '1px solid #4caf50');
                    $(".email2").css("color", '#4caf50');
                    state = false;
                }
                if (data.errors.password) {
                    document.getElementById('error-password2').innerHTML = data.errors.password;
                    $("#password2").css("border", '1px solid #ec2a2a');
                    $(".password2").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-password2').innerHTML = '';
                    $("#password2").css("border", '1px solid #4caf50');
                    $(".password2").css("color", '#4caf50');
                    state = false;
                }
                if (data.errors.password_confirmation) {
                    document.getElementById('error-password_confirmation2').innerHTML = data.errors.password_confirmation;
                    $("#password_confirmation2").css("border", '1px solid #ec2a2a');
                    $(".password_confirmation2").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-password_confirmation2').innerHTML = '';
                    $("#password_confirmation2").css("color", '1px solid #4caf50');
                    $(".password_confirmation2").css("color", '#4caf50');
                    state = false;
                }
                if (data.errors.password_equal) {
                    document.getElementById('error-password_confirmation2').innerHTML = data.errors.password_equal;
                    $("#password_confirmation2").css("border", '1px solid #ec2a2a');
                    $(".password_confirmation2").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-password_confirmation2').innerHTML = '';
                    $("#password_confirmation2").css("border", '1px solid #4caf50');
                    $(".password_confirmation2").css("color", '#4caf50');
                    state = false;
                }
            }
        } catch (error) {
            console.error(error);
        }
    },

}

$('#signIn2').on('click', () => { auth_repartidor.signIn() })