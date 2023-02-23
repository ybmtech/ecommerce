<script>
    $(document).ready(function() {
        //add product category
        $('#add_category_form').validate({
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
                    url: "validate/product-category.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#add_category_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'product-category'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'product-category'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#add_category_btn").attr('disabled', false).html("Add");
                        }
                    }
                });
                return false;
            }
        });
        //end add product category
        //edit product category
        $('#edit_category_form').validate({
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
                    url: "validate/edit-product-category.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#edit_category_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'product-category'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'product-category'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#edit_category_btn").attr('disabled', false).html("Update");
                        }
                    }
                });
                return false;
            }
        });
//end edit product category
//delete product category
$('#delete_category_form').validate({
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
                        $("#delete_category_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'product-category'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'product-category'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#delete_category_btn").attr('disabled', false).html("yes");
                        }
                    }
                });
                return false;
            }
        });
//end delete product category
    });
</script>