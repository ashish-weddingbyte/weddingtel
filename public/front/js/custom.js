$("document").ready(function () {
    // code for resend otp 30 seconde timer.
    // var time_limit = 40;
    // var time_out = setInterval(() => {
    //     if(time_limit == 0) {
    //         $('#otp_timer').html('Time Over');
    //     } else {
    //         if(time_limit < 10) {
    //             time_limit = 0 + '' + time_limit;
    //         }
    //         $('#otp_timer').html('00:' + time_limit);
    //         time_limit -= 1;
    //     }
    // }, 1000);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".submit", this).on("submit", function (event) {
        event.preventDefault();
        var url = $(this).attr("data-action");
        var form_data = $(this).serialize();

        $.ajax({
            url: url,
            method: "POST",
            data: form_data,
            success: function (response) {
                // console.log(response);
                // alert(response);
                location.reload();
            },
            error: function (response) {
                // console.log(response);
                $(".print-error-msg").empty();
                var errors = response.responseJSON.errors;
                var str = "";
                $.each(errors, function (key, value) {
                    str += "<p>" + value + "</p>"; // build the list
                });
                $(".print-error-msg").append(str);
            },
        });
    });

    $(".upcoming-task input[type=checkbox]").click(function () {
        var status = $(this).attr("data-status");
        var id = $(this).attr("data-id");
        var url = $(this).attr("data-action");

        $.ajax({
            url: url,
            method: "POST",
            data: { id: id, status: status },
            success: function (response) {
                if (response.status == "0") {
                    $("#customCheck-" + id)
                        .next()
                        .addClass("checked-label-text");
                } else {
                    $("#customCheck-" + id)
                        .next()
                        .removeClass("checked-label-text");
                }
            },
            error: function (response) {
                // console.log(response);
            },
        });
    });

    $(".open-modal-check").click(function () {
        $(".print-error-msg").empty();
    });

    $(function () {
        // Multiple images preview with JavaScript
        var previewImages = function (input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $($.parseHTML("<img>"))
                            .attr("src", event.target.result)
                            .appendTo(imgPreviewPlaceholder);
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $("#gallery").on("change", function () {
            previewImages(this, "div.images-preview-div");
        });
    });

    $(".wishlist", this).click(function () {
        var status = $(this).attr("data-status");
        var id = $(this).attr("data-vendor-id");
        var url = $(this).attr("data-action");

        $.ajax({
            url: url,
            method: "POST",
            data: { vendor_id: id, status: status },
            success: function (response) {
                if (response.status == "0") {
                    $("#wishlist-" + id).removeClass("wishlist-active");
                    $("#wishlist-" + id).attr("data-status", response.status);
                }
                if (response.status == "1") {
                    $("#wishlist-" + id).addClass("wishlist-active");
                    $("#wishlist-" + id).attr("data-status", response.status);
                }
            },
            error: function (response) {
                console.log(response);
            },
        });
    });

    /** ================= Vendor Code ==================================== */

    $(".view-button", this).click(function () {
        var id = $(this).attr("data-id");
        var url = $(this).attr("data-action");

        $.ajax({
            url: url,
            method: "POST",
            data: { id: id },
            async: false,
            success: function (response) {
                if (response.status == "0") {
                    $(".print-error-msg").empty();
                    $(".print-error-msg").append(response.message);
                }
                if (response.status == "1") {
                    location.href =
                        "http://localhost/weddingtel/vendor/leads/view/details/" +
                        id;
                }
                console.log(response);
            },
            error: function (response) {
                $(".print-error-msg").empty();
                var errors = response.responseJSON.errors;
                var str = "";
                $.each(errors, function (key, value) {
                    str +=
                        '<div class="alert alert-danger" >' + value + "</div>"; // build the list
                });
                $(".print-error-msg").append(str);
                // console.log(response);
            },
        });
    });

    // send message request or view contact request
    $(".query", this).on("submit", function (event) {
        event.preventDefault();
        var url = $(this).attr("data-action");
        var form_data = $(this).serialize();
        $(".error").empty();

        $.ajax({
            url: url,
            method: "POST",
            data: form_data,
            success: function (response) {
                if (response.query_type == "send_message") {
                    if (response.status == "1") {
                        $(".send-message-message").html(response.message);
                    }

                    if (response.type == "otp") {
                        $(".send-message-form").addClass("d-none");
                        $(".send-message-otp-div").removeClass("d-none");
                        $("#otp_id").val(response.otp_id);
                        $("#query_id").val(response.query_id);
                        $("#mobile").text(response.mobile);
                        $("#type").val(response.query_type);
                    }
                }

                if (response.query_type == "view_contact") {
                    if (response.status == "1") {
                        $(".send-message-message").html(response.message);
                    }

                    if (response.type == "otp") {
                        $(".view-contact-form").addClass("d-none");
                        $(".view-contact-otp-div").removeClass("d-none");
                        $("#otp_id_1").val(response.otp_id);
                        $("#query_id_1").val(response.query_id);
                        $("#mobile_1").text(response.mobile);
                        $("#type_1").val(response.query_type);
                    }

                    if (response.verify == "yes") {
                        $(".view-contact-message").empty();
                        $(".view-contact-form").empty();
                        $(".view-contact-otp-div").addClass("d-none");
                        $(".view-contact-vendor").html(response.data);
                    }
                }
            },
            error: function (response) {
                var res = $.parseJSON(response.responseText);
                $.each(res.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                    $("#" + key + "_error").removeClass("d-none");
                });
            },
        });
    });

    $(".verify_otp").on("submit", function (event) {
        event.preventDefault();
        var url = $(this).attr("data-action");
        var form_data = $(this).serialize();

        $.ajax({
            url: url,
            method: "POST",
            data: form_data,
            success: function (response) {
                $(".error").empty();

                if (response.status == "0") {
                    $(".send-message-message").html(response.message);
                }

                if (response.query_type == "send_message") {
                    if (response.status == "1") {
                        $(".send-message-message").html(response.message);
                    }
                }
                if (response.query_type == "view_contact") {
                    if (response.verify == "no") {
                        $(".view-contact-message").html(response.message);
                    }

                    if (response.verify == "yes") {
                        $(".view-contact-message").empty();
                        $(".view-contact-otp-div").addClass("d-none");
                        $(".view-contact-vendor").html(response.data);
                    }
                }
            },
            error: function (response) {
                $(".send-message-message").empty();
                var res = $.parseJSON(response.responseText);
                $.each(res.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                    $("#" + key + "_error").removeClass("d-none");
                });
            },
        });
    });

    // multistep form
    var current = 1,
        current_step,
        next_step,
        steps;
    steps = $("fieldset").length;
    $(".next").click(function () {
        current_step = $(this).parent();
        next_step = $(this).parent().next();
        next_step.show();
        current_step.hide();
        setProgressBar(++current);
    });
    $(".previous").click(function () {
        current_step = $(this).parent();
        next_step = $(this).parent().prev();
        next_step.show();
        current_step.hide();
        setProgressBar(--current);
    });
    setProgressBar(current);
    // Change progress bar action
    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed() - 10;
        $(".progress-bar")
            .css("width", percent + "%")
            .html(percent + "%");
    }

    $("#mobile").focusout(function () {
        var phone = $(this).val();
        var url = $("#contact-form").attr("data-action");

        if (phone.length < 10) {
            alert("Please Enter Correct Moile Number.");
        } else {
            $.ajax({
                url: url,
                type: "POST",
                data: { mobile: phone },
                success: function (data) {
                    // alert(data.id);
                    $(".contact_id").append(data.id);
                },
            });
        }
    });
});
