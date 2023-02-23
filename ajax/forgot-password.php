<script src="js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#forgot-password-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }

            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/forgot-password.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                    $("#forgot-password-btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
              
                    },
                    success: function(data) {
                        var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            $("#reset-msg").text(res.message);
                            $("#email").val("");
                             $("#forgot-password-btn").attr('disabled', false).html("Reset Password");
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'forgot-password'
                                }, delay);
                            } else {
                                //error
                                $("#reset-msg").text(res.message);
                                $("#forgot-password-btn").attr('disabled', false).html("Reset Password");
                            }


                        }
                    }
                });
                return false;
            }
        });
    });
</script>