<script src="js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#register-form').validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/register.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#register").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>please wait");
                    },
                    success: function(data) {
                        var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            setTimeout(function() {
                                window.location.href = 'verify'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 2000;
                                setTimeout(function() {
                                    window.location.href = 'register'
                                }, delay);
                            } else {
                                //error
                                $(".msg").html(res.message);
                            }

                            $("#register").attr('disabled', false).html("Register");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>