const auth = {
    async signIn() {
        const credentials = {
            email: $('#userEmail').val(),
            password: $('#userPassword').val(),
        }


        const success = `<div class="notification closeable success" style=" margin-bottom: 5px;">
                            <p><span>Exito!</span> Ah Iniciado sesion correctamente.</p>
                           
                        </div>`
        const process = `<div class="notification closeable notice" style = " margin-bottom: 5px;" >
                            <p><span>Enviando!</span> Informacion, Por favor espere...</p>
                         
                        </div>`
        const error = `<div class="notification closeable error" style=" margin-bottom: 5px;">
                            <p><span>Error!</span> A ocurrido un error.</p>
                          
                        </div>`

        const { status, data: data } = await axios.post('/sign-in', credentials);
        $('#login-result').empty().append(process);
        setTimeout(function () {
            if (data.errors) {
                if (data.errors.password) {
                    document.getElementById('error-userPassword').innerHTML = data.errors.password;
                    $("#userPassword").css("border", '1px solid #ec2a2a');
                    $(".userPassword").css("color", '#ec2a2a');
                    state = true;
                } else {
                    document.getElementById('error-userPassword').innerHTML = '';
                    $("#userPassword").css("border", '1px solid #4caf50');
                    $(".userPassword").css("color", '#4caf50');

                }
                if (data.errors.email) {
                    document.getElementById('error-userEmail').innerHTML = data.errors.email;
                    $("#userEmail").css("border", '1px solid #ec2a2a');
                    $(".userEmail").css("color", '#ec2a2a');
                    state = true;
                } else {

                    if (data.errors.email_register) {
                        document.getElementById('error-userEmail').innerHTML = data.errors.email_register;
                        $("#userEmail").css("border", '1px solid #ec2a2a');
                        $(".userEmail").css("color", '#ec2a2a');
                        state = true;
                    } else {
                        document.getElementById('error-userEmail').innerHTML = '';
                        $("#userEmail").css("border", '1px solid #4caf50');
                        $(".userEmail").css("color", '#4caf50');
                    }

                }

            }
            if (data.status == 200) {
                document.getElementById('error-userPassword').innerHTML = '';
                document.getElementById('error-userEmail').innerHTML = '';


                $('#login-result').empty().append(success);
                $("#userPassword").css("border", '1px solid #4caf50');
                $(".userPassword").css("color", '#4caf50');
                $("#userEmail").css("border", '1px solid #4caf50');
                $(".userEmail").css("color", '#4caf50');
                location.reload();
            } else {
                $('#login-result').empty().append(error);
            }
        }, 1000);


    },
    async signUp() {

        const credentials = {
            names: $('#userNames2').val(),
            lastnames: $('#userLastNames2').val(),
            email: $('#userEmail2').val(),
            cellphone: $('#userCellPhone2').val(),
            dni: $('#userDni2').val(),
            phone: $('#userPhone2').val(),
            password: $('#userPassword2').val(),
            password_confirmation: $('#userPassword_confirmation2').val(),
        }
        const success = `<div class="notification closeable success" style=" margin-bottom: 5px;">
                            <p><span>Exito!</span> Se ah registrado correctamente.</p>
                        </div>`
        const process = `<div class="notification closeable notice" style = " margin-bottom: 5px;" >
                            <p><span>Enviando!</span> Informacion, Por favor espere...</p>
                        </div>`
        const error = `<div class="notification closeable error" style=" margin-bottom: 5px;">
                            <p><span>Error!</span> A ocurrido un error.</p>
                        </div>`

        const { data: data } = await axios.post('/sign-up', credentials)
        $('#register-result').empty().append(process);
        setTimeout(function () {
            if (data.errors) {

                if (data.errors.names) {
                    document.getElementById('error-userNames2').innerHTML = data.errors.names;
                    $("#userNames2").css("border", '1px solid #ec2a2a');
                    $(".userNames2").css("color", '#ec2a2a');
                } else {
                    document.getElementById('error-userNames2').innerHTML = ''
                    $("#userNames2").css("border", '1px solid #4caf50');
                    $(".userNames2").css("color", '#4caf50');
                }
                if (data.errors.lastnames) {
                    document.getElementById('error-userLastNames2').innerHTML = data.errors.lastnames;
                    $("#userLastNames2").css("border", '1px solid #ec2a2a');
                    $(".userLastNames2").css("color", '#ec2a2a');

                } else {
                    document.getElementById('error-userLastNames2').innerHTML = ''
                    $("#userLastNames2").css("border", '1px solid #4caf50');
                    $(".userLastNames2").css("color", '#4caf50');

                }


                if (data.errors.dni) {
                    document.getElementById('error-userDni2').innerHTML = data.errors.dni;
                    $("#userDni2").css("border", '1px solid #ec2a2a');
                    $(".userDni2").css("color", '#ec2a2a');
                } else {
                    document.getElementById('error-userDni2').innerHTML = '';
                    $("#userDni2").css("border", '1px solid #4caf50');
                    $(".userDni2").css("color", '#4caf50');
                }


                if (data.errors.email) {
                    document.getElementById('error-userEmail2').innerHTML = data.errors.email;
                    $("#userEmail2").css("border", '1px solid #ec2a2a');
                    $(".userEmail2").css("color", '#ec2a2a');
                } else {

                    if (data.errors.email_register) {
                        document.getElementById('error-userEmail2').innerHTML = data.errors.email_register;
                        $("#userEmail2").css("border", '1px solid #ec2a2a');
                        $(".userEmail2").css("color", '#ec2a2a');
                    } else {
                        document.getElementById('error-userEmail2').innerHTML = '';
                        $("#userEmail2").css("border", '1px solid #4caf50');
                        $(".userEmail2").css("color", '#4caf50');
                    }
                    /*
                    document.getElementById('error-userEmail2').innerHTML = '';
                    $("#userEmail2").css("border", '1px solid #4caf50');
                    $(".userEmail2").css("color", '#4caf50');*/
                }
                if (data.errors.phone) {
                    document.getElementById('error-userPhone2').innerHTML = data.errors.phone;
                    $("#userPhone2").css("border", '1px solid #ec2a2a');
                    $(".userPhone2").css("color", '#ec2a2a');
                } else {
                    document.getElementById('error-userPhone2').innerHTML = '';
                    $("#userPhone2").css("border", '1px solid #4caf50');
                    $(".userPhone2").css("color", '#4caf50');
                }

                if (data.errors.cellphone) {
                    document.getElementById('error-userCellPhone2').innerHTML = data.errors.cellphone;
                    $("#userCellPhone2").css("border", '1px solid #ec2a2a');
                    $(".userCellPhone2").css("color", '#ec2a2a');
                } else {
                    document.getElementById('error-userCellPhone2').innerHTML = '';
                    $("#userCellPhone2").css("border", '1px solid #4caf50');
                    $(".userCellPhone2").css("color", '#4caf50');
                }


                if (data.errors.password) {
                    document.getElementById('error-userPassword2').innerHTML = data.errors.password;
                    $("#userPassword2").css("border", '1px solid #ec2a2a');
                    $(".userPassword2").css("color", '#ec2a2a');
                } else {
                    if (data.errors.password_equal) {
                        document.getElementById('error-userPassword_confirmation2').innerHTML = data.errors.password_equal;
                        $("#userPassword_confirmation2").css("border", '1px solid #ec2a2a');
                        $(".userPassword_confirmation2").css("color", '#ec2a2a');
                        document.getElementById('error-userPassword2').innerHTML = data.errors.password_equal;
                        $("#userPassword2").css("border", '1px solid #ec2a2a');
                        $(".userPassword2").css("color", '#ec2a2a');
                    } else {
                        document.getElementById('error-userPassword_confirmation2').innerHTML = '';
                        $("#userPassword_confirmation2").css("border", '1px solid #4caf50');
                        $(".userPassword_confirmation2").css("color", '#4caf50');

                        document.getElementById('error-userPassword2').innerHTML = '';
                        $("#userPassword2").css("border", '1px solid #4caf50');
                        $(".userPassword2").css("color", '#4caf50');
                    }

                }
                if (data.errors.password_confirmation) {
                    document.getElementById('error-userPassword_confirmation2').innerHTML = data.errors.password_confirmation;
                    $("#userPassword_confirmation2").css("border", '1px solid #ec2a2a');
                    $(".userPassword_confirmation2").css("color", '#ec2a2a');
                } else {
                    if (data.errors.password_equal) {
                        document.getElementById('error-userPassword_confirmation2').innerHTML = data.errors.password_equal;
                        $("#userPassword_confirmation2").css("border", '1px solid #ec2a2a');
                        $(".userPassword_confirmation2").css("color", '#ec2a2a');
                        document.getElementById('error-userPassword2').innerHTML = data.errors.password_equal;
                        $("#userPassword2").css("border", '1px solid #ec2a2a');
                        $(".userPassword2").css("color", '#ec2a2a');
                    } else {
                        document.getElementById('error-userPassword_confirmation2').innerHTML = '';
                        $("#userPassword_confirmation2").css("border", '1px solid #4caf50');
                        $(".userPassword_confirmation2").css("color", '#4caf50');

                        document.getElementById('error-userPassword2').innerHTML = '';
                        $("#userPassword2").css("border", '1px solid #4caf50');
                        $(".userPassword2").css("color", '#4caf50');
                    }
                }

            }
            if (data.status == 200) {
                $('#register-result').empty().append(success);
                $("#userPassword2").css("border", '1px solid #4caf50');
                $(".userPassword2").css("color", '#4caf50');

                $("#userEmail2").css("border", '1px solid #4caf50');
                $(".userEmail2").css("color", '#4caf50');

                $("#userDni2").css("border", '1px solid #4caf50');
                $(".userDni2").css("color", '#4caf50');

                $("#userNames2").css("border", '1px solid #4caf50');
                $(".userNames2").css("color", '#4caf50');

                $("#userPhone2").css("border", '1px solid #4caf50');
                $(".userPhone2").css("color", '#4caf50');

                $("#userCellPhone2").css("border", '1px solid #4caf50');
                $(".userCellPhone2").css("color", '#4caf50');

                $("#userLastNames2").css("border", '1px solid #4caf50');
                $(".userLastNames2").css("color", '#4caf50');

                document.getElementById('error-userLastNames2').innerHTML = ''
                document.getElementById('error-userEmail2').innerHTML = ''
                document.getElementById('error-userPassword_confirmation2').innerHTML = '';
                document.getElementById('error-userPassword2').innerHTML = '';
                document.getElementById('error-userPhone2').innerHTML = '';
                document.getElementById('error-userCellPhone2').innerHTML = '';
                document.getElementById('error-userDni2').innerHTML = '';


                $("#userPassword_confirmation2").css("border", '1px solid #4caf50');
                $(".userPassword_confirmation2").css("color", '#4caf50');

                setTimeout(function () {
                    $("#administrator").addClass("active");
                    $("#register").removeClass("active");
                    $("#tab1").css("display", "flow-root");
                    $("#tab2").css("display", "none");
                }, 1000);



            } else {
                $('#register-result').empty().append(error);
            }

        }, 1000);
    },

}
$('#signUpCostumer').on('click', () => { auth.signUp() })
$('#signInCostumer').on('click', () => { auth.signIn() })


