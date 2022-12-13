$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $(".body1").hide();
    $(".app").hide();

    if (faculty_tabs == "") {
        $('input[name="tab_section"]').each(function () {
            this.checked = false;
        });
        $(".tabContent").hide();
        $(".tabContent").find(".form-control").attr("required", false);
        $(".tabContent").find(".tab_title").attr("required", false);
    } else {
        $(".tabContent").show();
        $(".tabContent").find(".form-control").attr("required", false);
        $(".tabContent").find(".tab_title").attr("required", true);
    }

    if (faculty_type == "founder") {
        $(".body1").show();
        $("#long_desc1").html("Awards");
    } else if (faculty_type == "doctor") {
        $(".app").show();
    } else {
        $(".app").hide();
        $(".body1").hide();
        $("#long_desc1").html("Body 1");
    }
});

$("#type").change(function () {
    $(".app").hide();
    if ($("#type").val() == "founder") {
        $(".body1").show();
        $("#long_desc1").html("Awards");
    } else if ($("#type").val() == "doctor") {
        $(".app").show();
    } else {
        $(".app").hide();
        $(".body1").hide();
        $("#long_desc1").html("Body 1");
    }
});

$("#tab_section").change(function () {
    var checked = $(this).is(":checked");
    if (checked) {
        $(".tabContent").show();
        $(".tabContent").find(".tab_title").attr("required", true);
    } else {
        $(".tabContent").hide();
        $(".tabContent").find(".tab_title").attr("required", false);
    }
});

var cnt = 2;
$("#tbl_add").click(function () {
    var index = $("#tbl1 select").length + 1;
    var lastRowIndex = $("#custom_table tr:last").index() + 1;

    //Clone the DropDownList
    // var clonedRow = $("#tbl1 tr").last().clone();
    // $('#tbl1').last().append(clonedRow);
    // $('#tbl1 tr').last().find('#remove').removeClass('hide');

    var ddl =
        '<tr><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Event Date</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group"><div class="input-group input-append date datePicker1" id="datePicker1"><input type="text" id="event_date[' +
        lastRowIndex +
        ']" name="event_date[' +
        lastRowIndex +
        ']" class="form-control" placeholder="DD/MM/YYYY" value="" autocomplete="off"><span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div></div></td><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Event Title</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group"><input type="text" class="form-control" id="event_title[' +
        lastRowIndex +
        ']" name="event_title[' +
        lastRowIndex +
        ']" value=""></div></div></div></td><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Start Time</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group"><input type="text" class="form-control" id="start_time[' +
        lastRowIndex +
        ']" name="start_time[' +
        lastRowIndex +
        ']" value=""></div></div></div></td><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">End Time</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group"><input type="text" class="form-control" id="end_time[' +
        lastRowIndex +
        ']" name="end_time[' +
        lastRowIndex +
        ']" value=""></div></div></div></td><td><a class="btn btn-danger btn-xs btn-block tbl_rem1" href=" "><i class="fa fa-remove"></i></a></td></tr>';

    // ddl.find('#tab_title').val('');
    // ddl.find('textarea').attr('id','tab_body'+lastRowIndex);
    // ddl.find('textarea').attr('name','tab_body'+lastRowIndex);
    $("#tbl1").last().append(ddl);

    //CKEDITOR.replace('tab_body['+lastRowIndex+']', {customConfig: '/adminlte/js/ckeditor.js'})

    var date = new Date();
    $(".datePicker1").datepicker({
        format: "dd/mm/yyyy",
        endDate: new Date(),
    });

    cnt++;
});

$(".tbl_rem").click(function () {
    var rowCount = 0;
    if ($("#custom_table tr").length > 2) {
        var rowCount = 1;
    }

    if ($("#custom_table tr").length > 1) {
        // var Id = $('#tbl1 tr:last-child').attr('value');
        var Id = $(this).parent().parent().find(".tab_id").val();
        var closest_tr = $(this).closest("tr");
        if (Id == 0) {
            closest_tr.remove();
            return false;
        }
        swal({
            title: "Really destroy link ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then(function () {
            back.spin();
            $.ajax({
                url: "/admin/gallery/deleteTabSections",
                type: "post",
                data: { id: Id },
                // dataType: 'json',
            })
                .done(function (message) {
                    back.unSpin();
                    if (message.rowCount == 0) {
                        location.reload();
                    } else {
                        closest_tr.remove();
                    }
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    swal("No response from server");
                });
        });
    } else {
        swal("One tab section should be present in the page");
    }
});

$(document).on("click", ".popup_selector_tab_new", function (event) {
    event.preventDefault();
    var updateID = $(this).attr("data-inputid_tab_new");
    var elfinderUrl = "/elfinder/popup/";
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: "70%",
        height: "70%",
    });
});

$(document).on("click", ".tbl_rem1", function (event) {
    event.preventDefault();
    // alert($('#custom_table tr').length);
    if ($("#custom_table tr").length > 1) {
        $("#tbl1 tr:last-child").remove();
    } else {
        swal("One entry should be present in the page");
    }
});

$("#post_id").change(function (e) {
    e.preventDefault();
    var Id = $(this).val();
    var selectedVal = null;
    getSubContent(Id, selectedVal);
});

function getSubContent(Id, selectedVal) {
    if (Id != "") {
        $.ajax({
            url: "/admin/faculties/subcontent",
            type: "GET",
            data: { id: Id },
            dataType: "json",
        })
            .done(function (message) {
                //$("#sub_menu_id option").remove();
                $("#post_tab_id").empty();
                $("#post_tab_id").append(
                    // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                        .text("--Select--")
                        .val("")
                );

                $.each(message, function (index, item) {
                    console.log(message);
                    // Iterates through a collection
                    if (selectedVal != null) {
                        if (index == selectedVal) {
                            $("#post_tab_id").append(
                                // Append an object to the inside of the select box
                                $("<option selected></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        } else {
                            $("#post_tab_id").append(
                                // Append an object to the inside of the select box
                                $("<option></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        }
                    } else {
                        $("#post_tab_id").append(
                            // Append an object to the inside of the select box
                            $("<option></option>") // Yes you can do this.
                                .text(item)
                                .val(index)
                        );
                    }
                });
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                swal("No response from server");
            });
    }
}
