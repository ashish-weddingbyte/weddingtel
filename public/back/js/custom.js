jQuery(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $(".dataTable").DataTable({
        autoWidth: false,
        responsive: true,
        columnDefs: [
            {
                targets: [0],
                orderable: false,
            },
        ],
    });

    $("#checkAll").click(function () {
        if ($(this).is(":checked", true)) {
            $(".sub_chk").prop("checked", true);
        } else {
            $(".sub_chk").prop("checked", false);
        }
    });

    $(".submit", this).on("click", function (event) {
        event.preventDefault();
        var ids = [];
        $(".sub_chk:checked").each(function () {
            ids.push($(this).attr("data-id"));
        });

        var url = $(this).attr("data-action");
        var action = $(this).attr("data-action-type");

        if (ids.length <= 0) {
            alert("Please Select atleast one record!");
        } else {
            var join_selected_values = ids.join(",");
            $.ajax({
                url: url,
                method: "post",
                data: { ids: join_selected_values, action: action, url: url },
                success: function (response) {
                    // console.log(response);
                    // alert(response);
                    location.reload();
                },
                error: function (response) {},
            });
        }
    });

    //Initialize Select2 Elements
    $(".select2").select2();

    $("#city").on("change", function () {
        var data = $(".select2 option:selected").val();
        if (data.length <= 0) {
            alert("Select City for Check Available Positions!");
        } else {
            // var join_selected_values = ids.join(",");
            $.ajax({
                url: url,
                method: "post",
                data: { id: data, url: url },
                success: function (response) {
                    // console.log(response);
                    // alert(response);
                    location.reload();
                },
                error: function (response) {},
            });
        }
    });
});
