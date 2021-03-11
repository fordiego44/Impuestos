const auth_user = {
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
        $('#login-user-result').empty().append(process);

        const info = await axios.post('/login', credentials);
        setTimeout(function () {

            let data = info.data;
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
                $('#login-user-result').empty().append(success);
                document.getElementById('error-password').innerHTML = '';
                document.getElementById('error-email').innerHTML = '';
                $("#password").css("border", '1px solid #4caf50');
                $(".password").css("color", '#4caf50');
                $("#email").css("border", '1px solid #4caf50');
                $(".email").css("color", '#4caf50');
                return document.location.pathname = '/admin/profile';
            } else {
                $('#login-user-result').empty().append(error);
            }
        }, 1000);
    },
    async signUp() {

        const credentials = {
            names: $('#names2').val(),
            lastnames: $('#lastnames2').val(),
            email: $('#email2').val(),
            phone: $('#phone2').val(),
            cellphone: $('#cellPhone2').val(),
            password: $('#password2').val(),
            password_confirmation: $('#password_confirmation2').val(),
            business: $('#bussines').val(),

        }
        const success = `<div class="notification closeable success" style=" margin-bottom: 5px;">
                            <p><span>Exito!</span> Se ah registrado correctamente.</p>
                            <a class="close"></a>
                        </div>`
        const process = `<div class="notification closeable notice" style = " margin-bottom: 5px;" >
                            <p><span>Enviando!</span> Informacion, Por favor espere...</p>
                            <a class="close"></a>
                        </div>`
        const error = `<div class="notification closeable error" style=" margin-bottom: 5px;">
                            <p><span>Error!</span> A ocurrido un error.</p>
                            <a class="close"></a>
                        </div>`

        $('#register-user-result').empty().append(process);

        const { status, data: data } = await axios.post('/register', credentials)
        setTimeout(function () {

            if (data.errors) {
                if (data.errors.names) {
                    document.getElementById('error-names2').innerHTML = data.errors.names;
                    $("#names2").css("border", '1px solid #ec2a2a');
                    $(".names2").css("color", '#ec2a2a');

                } else {
                    document.getElementById('error-names2').innerHTML = ''
                    $("#names2").css("border", '1px solid #4caf50');
                    $(".names2").css("color", '#4caf50');

                }
                if (data.errors.lastnames) {
                    document.getElementById('error-lastnames2').innerHTML = data.errors.lastnames;
                    $("#lastnames2").css("border", '1px solid #ec2a2a');
                    $(".lastnames2").css("color", '#ec2a2a');

                } else {
                    document.getElementById('error-lastnames2').innerHTML = ''
                    $("#lastnames2").css("border", '1px solid #4caf50');
                    $(".lastnames2").css("color", '#4caf50');

                }


                if (data.errors.phone) {
                    document.getElementById('error-phone2').innerHTML = data.errors.phone;
                    $("#phone2").css("border", '1px solid #ec2a2a');
                    $(".phone2").css("color", '#ec2a2a');

                } else {
                    document.getElementById('error-phone2').innerHTML = ''
                    $("#phone2").css("border", '1px solid #4caf50');
                    $(".phone2").css("color", '#4caf50');
                }
                if (data.errors.cellphone) {
                    document.getElementById('error-cellPhone2').innerHTML = data.errors.cellphone;
                    $("#cellPhone2").css("border", '1px solid #ec2a2a');
                    $(".cellPhone2").css("color", '#ec2a2a');

                } else {
                    document.getElementById('error-cellPhone2').innerHTML = ''
                    $("#cellPhone2").css("border", '1px solid #4caf50');
                    $(".cellPhone2").css("color", '#4caf50');

                }

                if (data.errors.email_register) {
                    document.getElementById('error-email2').innerHTML = data.errors.email_register;
                    $("#email2").css("border", '1px solid #ec2a2a');
                    $(".email2").css("color", '#ec2a2a');

                } else {
                    if (data.errors.email) {
                        document.getElementById('error-email2').innerHTML = data.errors.email;
                        $("#email2").css("border", '1px solid #ec2a2a');
                        $(".email2").css("color", '#ec2a2a');

                    } else {
                        document.getElementById('error-email2').innerHTML = '';
                        $("#email2").css("border", '1px solid #4caf50');
                        $(".email2").css("color", '#4caf50');
                    }
                }
                if (data.errors.password) {
                    document.getElementById('error-password2').innerHTML = data.errors.password;
                    $("#password2").css("border", '1px solid #ec2a2a');
                    $(".password2").css("color", '#ec2a2a');
                } else {
                    document.getElementById('error-password2').innerHTML = '';
                    $("#password2").css("border", '1px solid #4caf50');
                    $(".password2").css("color", '#4caf50');
                }
                if (data.errors.password_confirmation) {
                    document.getElementById('error-password_confirmation2').innerHTML = data.errors.password_confirmation;
                    $("#password_confirmation2").css("border", '1px solid #ec2a2a');
                    $(".password_confirmation2").css("color", '#ec2a2a');
                } else {
                    $("#password2").css("border", '1px solid #ec2a2a');
                    $(".password2").css("color", '#ec2a2a');
                    document.getElementById('error-password_confirmation2').innerHTML = '';
                    $("#password_confirmation2").css("color", '1px solid #4caf50');
                    $(".password_confirmation2").css("color", '#4caf50');

                }
                if (data.errors.password_equal) {
                    document.getElementById('error-password2').innerHTML = data.errors.password_equal;
                    $("#password2").css("border", '1px solid #ec2a2a');
                    $(".password2").css("color", '#ec2a2a');

                    document.getElementById('error-password_confirmation2').innerHTML = data.errors.password_equal;
                    $("#password_confirmation2").css("border", '1px solid #ec2a2a');
                    $(".password_confirmation2").css("color", '#ec2a2a');
                } else {
                    document.getElementById('error-password2').innerHTML = '';
                    $("#password2").css("border", '1px solid #4caf50');
                    $(".password2").css("color", '#4caf50');

                    document.getElementById('error-password_confirmation2').innerHTML = '';
                    $("#password_confirmation2").css("border", '1px solid #4caf50');
                    $(".password_confirmation2").css("color", '#4caf50');
                }
            }
            if (data.status == 200) {
                $('#register-user-result').empty().append(success);

                document.getElementById('error-names2').innerHTML = ''
                $("#names2").css("border", '1px solid #4caf50');
                $(".names2").css("color", '#4caf50');

                document.getElementById('error-lastnames2').innerHTML = ''
                $("#lastnames2").css("border", '1px solid #4caf50');
                $(".lastnames2").css("color", '#4caf50');

                document.getElementById('error-email2').innerHTML = '';
                $("#email2").css("border", '1px solid #4caf50');
                $(".email2").css("color", '#4caf50');

                document.getElementById('error-phone2').innerHTML = '';
                $("#phone2").css("border", '1px solid #4caf50');
                $(".phone2").css("color", '#4caf50');

                document.getElementById('error-cellPhone2').innerHTML = '';
                $("#cellPhone2").css("border", '1px solid #4caf50');
                $(".cellPhone2").css("color", '#4caf50');
                //
                document.getElementById('error-password2').innerHTML = '';
                $("#password2").css("border", '1px solid #4caf50');
                $(".password2").css("color", '#4caf50');

                document.getElementById('error-password2').innerHTML = '';
                $("#password2").css("border", '1px solid #4caf50');
                $(".password2").css("color", '#4caf50');

                document.getElementById('error-password_confirmation2').innerHTML = '';
                $("#password_confirmation2").css("border", '1px solid #4caf50');
                $(".password_confirmation2").css("color", '#4caf50');

                setTimeout(function () {
                    $("#administrator1").addClass("active");
                    $("#register1").removeClass("active");
                    $("#tab1_v").css("display", "flow-root");
                    $("#tab2_v").css("display", "none");


                }, 1000);

            } else {
                $('#register-user-result').empty().append(error);
            }
        }, 1000);
    },

}

$('#signUp').on('click', () => { auth_user.signUp() })
$('#signIn').on('click', () => { auth_user.signIn() })