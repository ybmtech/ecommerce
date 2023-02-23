<script src="js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#reset-password-form').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }

            },
            messages: {
                password_confirmation: {
                    equalTo: 'Confirm password not match with password.'
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/reset-password.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#reset-password").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>please wait");
                    },
                    success: function(data) {
                        var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            $("#reset-msg").text(res.message);
                            $("#password").val("");
                            $("#password_confirmation").val("");
                            $("#reset-password").attr('disabled', false).html("Reset");
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'login'
                                }, delay);
                            } else {
                                //error
                                $("#reset-msg").text(res.message);
                                $("#reset-password").attr('disabled', false).html("Reset");
                            }


                        }
                    }
                });
                return false;
            }
        });
    });
</script>