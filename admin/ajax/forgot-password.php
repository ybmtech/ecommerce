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
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = './'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'forgot-password'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#forgot-password-btn").attr('disabled', false).html("Reset Password");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>