<script src="js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {
        $('#ContactForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                name: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                message: {
                    required: true,
                }

            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "mail/contact-form.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#contact-submit-btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                        var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            $("#alert").html(res.message);
                            $("#email").val(" ");
                            $("#phone").val(" ");
                            $("#message").val(" ");
                            $("#name").val(" ");
                            $("#contact-submit-btn").attr('disabled', false).html("SEND MESSAGE");
                        } else {
                                //error
                                $("#alert").html(res.message);
                                   $("#contact-submit-btn").attr('disabled', false).html("SEND MESSAGE");

                        }
                    }
                });
                return false;
            }
        });
    });
</script>