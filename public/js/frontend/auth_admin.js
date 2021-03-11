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
        $('#login-admin-result').empty().append(process);

        const { status, data: data } = await axios.post('/login-admin', credentials);
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
                    }
                }

            }
            if (data.status == 200) {
                $('#login-admin-result').empty().append(success);

                $("#password").css("border", '1px solid #4caf50');
                $(".password").css("color", '#4caf50');
                $("#email").css("border", '1px solid #4caf50');
                $(".email").css("color", '#4caf50');
                document.getElementById('error-email').innerHTML = '';
                document.getElementById('error-password').innerHTML = '';

                return document.location.pathname = '/superadmin/';

            } else {
                $('#login-admin-result').empty().append(error);
            }
        }, 1000);

    }
}

$('#signIn2').on('click', () => { auth_repartidor.signIn() })