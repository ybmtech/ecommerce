<script src="js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#profile-form').validate({
            rules: {
                fullname: {
                    required: true
                },
                phone: {
                    required: true
                },
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
                    url: "validate/profile.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#profile-btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>please wait");
                    },
                    success: function(data) {
                        //console.log(data);
                        var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            $("#profile-msg").html(res.message);
                            $("#profile-btn").attr('disabled', false).html("UPDATE");
                        } else {
                            if (res.error == "token") {
                                var delay = 2000;
                                setTimeout(function() {
                                    window.location.href = 'login'
                                }, delay);
                            } else {
                                //error
                                $("#profile-msg").html(res.message);
                            }

                            $("#profile-btn").attr('disabled', false).html("UPDATE");
                        }
                    }
                });
                return false;
            }
        });
    });
</script>