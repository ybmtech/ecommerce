<script>
    $(document).ready(function() {
        //change password
        $('#change_password_form').validate({
            rules: {
                old_password: {
                    required: true
                },
                new_password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                },
            },
            messages: {
                confirm_new_password: {
                    equalTo: 'Confirm password not match with new password.'
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/change-password.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#change_password_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                          var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'change-password'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'change-password'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#change_password_btn").attr('disabled', false).html("Change Password");
                        }
                    }
                });
                return false;
            }
        });
       
//change password

    });
</script>