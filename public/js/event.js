$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$(document).ready(function () {
    if (event_tabs == "") {
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

    if (actual_brochure == "Y") {
        $('input[name="brochure"]').each(function () {
            this.checked = true;
        });
    } else {
        $('input[name="brochure"]').each(function () {
            this.checked = false;
        });
    }

    $(".body1").show();
    $("#long_desc1").html("Body 1");
    $(".body2").hide();
    $(".news").hide();
    $(".upcoming_events").hide();
    $(".icon").hide();
    $(".course").hide();

    if (actual_parent_slug != null) {
        if (actual_parent_slug == "blog") {
            $(".news").show();
            $(".tab").hide();
            $("#event_date").attr("required", true);
        }

        if (actual_parent_slug == "about-us") {
            $(".body1").show();
            $(".tab").hide();
            $("#excerpt").attr("maxlength", "400");
            $("#long_desc1").html("Body 1");
            $(".icon").show();
            $(".icon h3").html("Home Image");
            // $('#long_desc2').html('Mission');
        }

        if (
            actual_parent_slug == "services" ||
            actual_parent_slug == "products"
        ) {
            $(".icon").show();
        }
    }

    if (actual_sub_menu != null) {
        $(".course").hide();
        // $(".news").hide();
        $(".upcoming_events").hide();

        if (actual_sub_slug == "courses") {
            $(".course").show();
        }
        if (actual_sub_slug == "blogs") {
            $(".news").show();
            $(".upcoming_events").hide();
            $(".tab").hide();
            $("#event_date").attr("required", true);
        }
        if (actual_sub_slug == "upcoming-events") {
            $(".upcoming_events").show();
            $(".news").hide();
            $(".tab").hide();
        }
    }

    /*$(".tabContent").hide();
 $(".tabContent").find('.form-control').attr('required',false);*/

    if (actual_event_from_date != null) {
        $("#event_from_date").val(actual_event_from_date);
        // $('#upcoming_event_date').val(actual_event_from_date);
    }
    if (actual_event_to_date != null) {
        $("#event_to_date").val(actual_event_to_date);
        // $('#upcoming_event_date').val(actual_event_to_date);
    }

    if (actual_event_to_date != null) {
        $("#upcoming_event_to_date").val(actual_event_to_date);
    }

    var menu = $("#parent_menu_id").val();
    if (menu != 0) {
        var selectedVal = actual_sub_menu;
        getSubmenu(menu, selectedVal);

        var selectedChildVal = actual_child_menu;
        getChildmenu(selectedVal, selectedChildVal);

        var selectedSubChildVal = actual_sub_child_menu;
        getSubChildmenu(selectedChildVal, selectedSubChildVal);
    }
});

$("#parent_menu_id").change(function (e) {
    var Id = $(this).val();
    var slug;
    $.ajax({
        url: "/admin/post/parentslug",
        type: "GET",
        data: { id: Id },
        dataType: "json",
    }).done(function (message) {
        slug = message.slug;

        // $("#title").val(message.name);
        // $("#meta_description").val(message.name);
        // $("#meta_keywords").val(message.name);
        // $("#seo_title").val(message.name);

        $(".body1").hide();
        $(".body2").hide();
        $(".body").show();
        $(".news").hide();
        $(".upcoming_events").hide();
        $(".tab").show();
        $(".icon").hide();
        $(".course").hide();

        if (slug == "blog") {
            $(".news").show();
            $(".tab").hide();
            $(".body1").hide();
            $(".body2").hide();
            $("#event_date").attr("required", true);
        } else if (slug == "services" || slug == "products") {
            $(".icon").show();
        } else if (slug == "about-us") {
            $(".body1").show();
            $(".tab").hide();
            $("#excerpt").attr("maxlength", "400");
            $("#long_desc1").html("Body 1");
            $(".icon").show();
            $(".icon h3").html("Home Image");
            // $('#long_desc2').html('Mission');
        } else {
            $(".body1").hide();
            $(".body2").hide();
            $(".body").show();
            $(".news").hide();
            $(".tab").show();
            $(".icon").hide();
        }
    });
    e.preventDefault();
    var selectedVal = null;
    getSubmenu(Id, selectedVal);
});

function getSubmenu(Id, selectedVal) {
    if (Id !== "") {
        $.ajax({
            url: "/admin/post/submenus",
            type: "GET",
            data: { id: Id },
            dataType: "json",
        })
            .done(function (message) {
                //$("#sub_menu_id option").remove();
                $("#sub_menu_id").empty();
                $("#sub_menu_id").append(
                    // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                        .text("--Select--")
                        .val("")
                );

                $("#child_menu_id").empty();
                $("#child_menu_id").append(
                    // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                        .text("--Select--")
                        .val("")
                );

                $.each(message, function (index, item) {
                    // Iterates through a collection
                    if (selectedVal != null) {
                        if (index == selectedVal) {
                            $("#sub_menu_id").append(
                                // Append an object to the inside of the select box
                                $("<option selected></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        } else {
                            $("#sub_menu_id").append(
                                // Append an object to the inside of the select box
                                $("<option></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        }
                    } else {
                        $("#sub_menu_id").append(
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

$("#sub_menu_id").change(function (e) {
    var Id = $(this).val();
    var slug;
    $.ajax({
        url: "/admin/post/subslug",
        type: "GET",
        data: { id: Id },
        dataType: "json",
    }).done(function (message) {
        slug = message.slug;
        // $("#title").val(message.name);
        // $("#meta_description").val(message.name);
        // $("#meta_keywords").val(message.name);
        // $("#seo_title").val(message.name);

        $(".course").hide();
        $(".news").hide();
        $(".upcoming_events").hide();

        if (slug == "courses") {
            $(".course").show();
        } else {
            $(".course").hide();
        }
        if (slug == "blogs") {
            $(".news").show();
            $(".upcoming_events").hide();
            $(".tab").hide();
            $(".body1").hide();
            $(".body2").hide();
            $("#event_date").attr("required", true);
        } else if (slug == "upcoming-events") {
            $(".upcoming_events").show();
            $(".news").hide();
            $(".tab").hide();
            $(".body1").hide();
            $(".body2").hide();
        } else {
            $(".body1").hide();
            $(".body2").hide();
            $(".news").hide();
            $(".upcoming_events").hide();
        }
    });
    e.preventDefault();
    var Id = $(this).val();
    var selectedChildVal = null;
    getChildmenu(Id, selectedChildVal);
});

function getChildmenu(Id, selectedChildVal) {
    if (Id !== "") {
        $.ajax({
            url: "/admin/post/childmenus",
            type: "GET",
            data: { id: Id },
            dataType: "json",
        })
            .done(function (message) {
                //  $("#child_menu_id option").remove();
                $("#child_menu_id").empty();
                $("#child_menu_id").append(
                    // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                        .text("--Select--")
                        .val("")
                );

                $.each(message, function (index, item) {
                    // Iterates through a collection
                    //
                    if (selectedChildVal != null) {
                        if (index == selectedChildVal) {
                            $("#child_menu_id").append(
                                // Append an object to the inside of the select box
                                $("<option selected></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        } else {
                            $("#child_menu_id").append(
                                // Append an object to the inside of the select box
                                $("<option></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        }
                    } else {
                        $("#child_menu_id").append(
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

$("#child_menu_id").change(function (e) {
    e.preventDefault();
    var Id = $(this).val();
    var selectedSubChildVal = null;
    getSubChildmenu(Id, selectedSubChildVal);
});

function getSubChildmenu(Id, selectedSubChildVal) {
    if (Id !== "") {
        $.ajax({
            url: "/admin/post/subchildmenus",
            type: "GET",
            data: { id: Id },
            dataType: "json",
        })
            .done(function (message) {
                //  $("#sub_child_menu_id option").remove();
                $("#sub_child_menu_id").empty();
                $("#sub_child_menu_id").append(
                    // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                        .text("--Select--")
                        .val("")
                );

                $.each(message, function (index, item) {
                    // Iterates through a collection
                    //
                    if (selectedSubChildVal != null) {
                        if (index == selectedSubChildVal) {
                            $("#sub_child_menu_id").append(
                                // Append an object to the inside of the select box
                                $("<option selected></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        } else {
                            $("#sub_child_menu_id").append(
                                // Append an object to the inside of the select box
                                $("<option></option>") // Yes you can do this.
                                    .text(item)
                                    .val(index)
                            );
                        }
                    } else {
                        $("#sub_child_menu_id").append(
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

$(document).on("click", "#submitPost", function () {
    var parent_menu_value = $("#parent_menu_id").val();

    // if (parent_menu_value == 0) {
    //     swal("Please select the menu");
    //     return false;
    // }

    if (actual_sub_menu != "") {
        var sub_menu_value = $("#sub_menu_id").val();
        if (sub_menu_value == 0) {
            swal("Please select Sub menu");
            return false;
        }
    }

    if (actual_child_menu != "") {
        var child_menu_value = $("#child_menu_id").val();
        if (child_menu_value == 0) {
            swal("Please select Child menu");
            return false;
        }
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
    // var ddl = '<tr><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Tab Title</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><input type="text" class="form-control" id="tab_title['+lastRowIndex+']" name="tab_title['+lastRowIndex+']" value="" required=""></div></div></div><div class="box box-solid box-primary"><div class="box-header with-border"><h3 class="box-title">Thumb Image</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><img id="tab_image"  src="" alt="" class="img-responsive img-fluid tab_image"></div><div class="box-footer"><div class=""><div class="input-group"><div class="input-group-btn"><a href="" class="popup_selector_tab_new btn btn-primary" data-inputid_tab_new="tab_image">Select an image</a></div><input class="form-control tab_image" type="text" id="tab_image['+lastRowIndex+']" name="tab_image['+lastRowIndex+']" value="" ></div></div></div></div><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Long Description</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><textarea class="form-control" rows="10" id="tab_body['+lastRowIndex+']" name="tab_body['+lastRowIndex+']" ></textarea></div></div></div></td></tr>';
    var ddl =
        '<tr><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Title</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><input type="text" class="form-control tab_title" id="tab_title[' +
        lastRowIndex +
        ']" name="tab_title[' +
        lastRowIndex +
        ']" value="" required=""></div></div></div><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Description</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><input type="text" class="form-control tab_image" id="tab_image[' +
        lastRowIndex +
        ']" name="tab_image[' +
        lastRowIndex +
        ']" value="" required=""></div></div></div><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Long Description</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><textarea class="form-control tab_body" rows="10" id="tab_body[' +
        lastRowIndex +
        ']" name="tab_body[' +
        lastRowIndex +
        ']" ></textarea></div></div></div></td></tr>';

    // ddl.find('#tab_title').val('');
    // ddl.find('textarea').attr('id','tab_body'+lastRowIndex);
    // ddl.find('textarea').attr('name','tab_body'+lastRowIndex);
    $("#tbl1").last().append(ddl);

    //

    CKEDITOR.replace("tab_body[" + lastRowIndex + "]", {
        customConfig: "/adminlte/js/ckeditor.js",
    });
    cnt++;
});

$("#tbl_rem").click(function () {
    if ($("#custom_table tr").length > 1) {
        var Id = $("#tbl1 tr:last-child").attr("value");

        if (Id != "") {
            $.ajax({
                url: "/admin/post/deleteTabSection",
                type: "DELETE",
                data: { id: Id },
                dataType: "json",
            })
                .done(function (message) {})
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    swal("No response from server");
                });
        }
        $("#tbl1 tr:last-child").remove();
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

var cnt = 2;
$("#tbl_add1").click(function () {
    var index = $("#tbl3 select").length + 1;
    //Clone the DropDownList
    var ddl = $("#tbl3 tr").first().clone();
    $("#tbl3").last().append(ddl);

    cnt++;
});

$("#tbl_rem1").click(function () {
    //alert($('#custom_table1 tr').length);
    if ($("#custom_table1 tr").length > 2) {
        $("#tbl3 tr:last-child").remove();
    } else {
        swal("One entry should be present in the page");
    }
});
