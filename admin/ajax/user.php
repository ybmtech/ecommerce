<script>
    $(document).ready(function() {
        //add user
        $('#add_user_form').validate({
            rules: {
                name: {
                    required: true,
                },
                phone:{
                    required: true,
                },
                email:{
                    required: true,
                    email: true,
                },
                role:{
                    required: true,
                }
            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/user.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#add_user_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'user'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'user'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#add_user_btn").attr('disabled', false).html("Add");
                        }
                    }
                });
                return false;
            }
        });
        //end add user
        //edit user
        $('#edit_user_form').validate({
            rules: {
                name: {
                    required: true,
                },
                phone:{
                    required: true,
                },
                email:{
                    required: true,
                    email: true,
                },
                role:{
                    required: true,
                }
            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/edit-user.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#edit_user_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'user'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'user'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#edit_user_btn").attr('disabled', false).html("Update");
                        }
                    }
                });
                return false;
            }
        });
//end edit user
//delete user
$('#delete_user_form').validate({
            rules: {
                name: {
                    required: true,
                },
            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/delete.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#delete_user_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'user'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'user'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#delete_user_btn").attr('disabled', false).html("yes");
                        }
                    }
                });
                return false;
            }
        });
//end delete user
    });
</script>