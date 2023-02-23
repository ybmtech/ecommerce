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
                            var delay=2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = './'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = './'
                                }, delay);
                            } else {
                                //error
                                swal(res.message, "", "error");
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