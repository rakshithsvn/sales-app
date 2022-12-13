$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$(document).ready(function(){


if(post_tabs == '')
{
    $('input[name="tab_section"]').each(function() {
      this.checked = false;
    });
     $(".tabContent").hide();
  $(".tabContent").find('.form-control').attr('required',false);
   $(".body").show();
}
else
{
   $(".tabContent").show();
  $(".tabContent").find('.form-control').attr('required',false);
   $(".body").hide();

}


});
 


 $("#tab_section").change(function() {
      var checked = $(this).is(":checked");
      if (checked) {
         $(".body").hide();
         $(".tabContent").show();
         
      }
      else{
         $(".body").show();
         $(".tabContent").hide();

        $("#tab_title").attr('required',false);
        $("#tab_body").attr('required',false);

      }
   });



  var cnt = 2;
   $("#tbl_add").click(function(){
   var index = $("#tbl1 select").length + 1;
var lastRowIndex = $("#custom_table tr:last").index() + 1;
    //Clone the DropDownList
        var ddl = '<tr><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Tab Title</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><input type="text" class="form-control" id="tab_title['+lastRowIndex+']" name="tab_title['+lastRowIndex+']" value="" required=""></div></div></div> <div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Long Description</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group "><textarea class="form-control" rows="10" id="tab_body['+lastRowIndex+']" name="tab_body['+lastRowIndex+']" required=""></textarea></div></div></div></td></tr>';

        $('#tbl1').last().append(ddl);


     CKEDITOR.replace('tab_body['+lastRowIndex+']', {customConfig: '/adminlte/js/ckeditor.js'})
   cnt++;
   });


  $("#tbl_rem").click(function(){

  if($('#custom_table tr').length >1){

    var Id = $('#tbl1 tr:last-child').attr('value');


    if(Id!=''){
           $.ajax({
               url:  "/admin/link/deleteTabSection",
               type: "DELETE",
               data: { id: Id},
            dataType: 'json',
         }).done(function (message) {


           })
           .fail(function (jqXHR, ajaxOptions, thrownError) {
               swal('No response from server');
           });


       }
   $('#tbl1 tr:last-child').remove();
   }
   else{
  swal('One tab section should be present in the page');
   }
   });