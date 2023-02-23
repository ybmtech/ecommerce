<script>
    $(document).ready(function() {
        //add currency
        $('#add_currency_form').validate({
            rules: {
                name: {
                    required: true,
                },
                symbol: {
                    required: true,
                },
                rate: {
                    required: true,
                },
            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/currency.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#add_currency_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'currency'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'currency'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#add_currency_btn").attr('disabled', false).html("Add");
                        }
                    }
                });
                return false;
            }
        });
        //end add currency
        //edit currency
        $('#edit_currency_form').validate({
            rules: {
                name: {
                    required: true,
                },
                symbol: {
                    required: true,
                },
                rate: {
                    required: true,
                },
            },
            messages: {

            },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: "validate/edit-currency.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#edit_currency_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'currency'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'currency'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#edit_currency_btn").attr('disabled', false).html("Update");
                        }
                    }
                });
                return false;
            }
        });
//end edit currency
//delete currency
$('#delete_currency_form').validate({
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
                        $("#delete_currency_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'currency'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'currency'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#delete_currency_btn").attr('disabled', false).html("yes");
                        }
                    }
                });
                return false;
            }
        });
//end delete currency
//default currency
$('#default_currency_form').validate({
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
                    url: "validate/default-currency.php",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#default_currency_btn").attr('disabled', true).html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function(data) {
                         var res = JSON.parse(data);
                        var status = res.status;
                        if (status == true) {
                            var delay = 2000;
                            swal(res.message, "", "success");
                            setTimeout(function() {
                                window.location.href = 'currency'
                            }, delay);
                        } else {
                            if (res.error == "token") {
                                var delay = 1000;
                                setTimeout(function() {
                                    window.location.href = 'currency'
                                }, delay);
                            }
                            else {
                                //error
                                swal(res.message, "", "error");
                            }

                            $("#default_currency_btn").attr('disabled', false).html("yes");
                        }
                    }
                });
                return false;
            }
        });
//end default currency
    });
</script>