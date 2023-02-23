<script src="js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#login-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {

            },
            submitHandler: function(form) {
                let order=$("#order").val();
                if(order==""){
                   var login_redirect="./";
                }
                else{
                   var login_redirect="checkout";
                }
                $.ajax({
                    type: "POST",
                    url: "validate/login.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#login").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>Login...");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            setTimeout(function() {
                                window.location.href = login_redirect
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'login'
                                }, delay);
                            }
                            if (res.error == "verify") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'verify'
                                }, delay);
                            } else {
                                //error
                                $("#login-msg").html(res.message);
                            }

                            $("#login").attr('disabled', false).html("Login");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>