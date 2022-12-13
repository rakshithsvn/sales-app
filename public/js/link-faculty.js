$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function(){



var page = $("#post_id").val();

if(page != 0)
  {
    var selectedVal = actual_post_tab;
    getSubContent(page,selectedVal);

  }


});



$("#post_id").change(function (e) {

        e.preventDefault();
         var Id = $(this).val();
         var selectedVal = null;
       getSubContent(Id,selectedVal);

    });

function getSubContent(Id,selectedVal){
  if(Id!=''){
           $.ajax({
               url:  "/admin/faculties/subcontent",
               type: "GET",
               data: { id: Id},
            dataType: 'json',
         }).done(function (message) {

                  //$("#sub_menu_id option").remove();
                    $("#post_tab_id").empty();
                  $("#post_tab_id").append( // Append an object to the inside of the select box
                    $("<option></option>") // Yes you can do this.
                    .text('--Select--')
                    .val('')
                    );
              
             $.each(message, function(index, item) {
              console.log(message);
              // Iterates through a collection
                if(selectedVal!=null){
                  if(index == selectedVal){
                    $("#post_tab_id").append( // Append an object to the inside of the select box
                     $("<option selected></option>") // Yes you can do this.
                         .text(item)
                         .val(index)
                 );
                  }else{
                    $("#post_tab_id").append( // Append an object to the inside of the select box
                     $("<option></option>") // Yes you can do this.
                         .text(item)
                         .val(index)
                 );
                  }
                 
                }else{
                  $("#post_tab_id").append( // Append an object to the inside of the select box
                     $("<option></option>") // Yes you can do this.
                         .text(item)
                         .val(index)
                 );
                }
                 
             });


           })
           .fail(function (jqXHR, ajaxOptions, thrownError) {
               swal('No response from server');
           });


       }
}





  var cnt = 2;
   $("#tbl_add").click(function(){
    var index = $("#tbl1 select").length + 1;
    var lastRowIndex = $("#custom_table tr:last").index() + 1;
    
    //Clone the DropDownList
    // var clonedRow = $("#tbl1 tr").last().clone();
    // $('#tbl1').last().append(clonedRow);
    // $('#tbl1 tr').last().find('#remove').removeClass('hide');

    var ddl = '<tr><td><div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Title</h3><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button></div></div><div class="box-body"><div class="form-group"><select id="faculty_id" name="faculty_id['+lastRowIndex+']" class="js-example-basic-single form-control" required="true">'+ faculty_names.forEach(function(faculty_id, id){ +'"<option value="'+ id +'">"'+ faculty_id +'"</option>"'+});+'"</select></div></div></div></td><td><a class="btn btn-danger btn-xs btn-block tbl_rem1" href=" "><i class="fa fa-remove"></i></a>  </td></tr>';

    // ddl.find('#tab_title').val('');
    // ddl.find('textarea').attr('id','tab_body'+lastRowIndex);
    // ddl.find('textarea').attr('name','tab_body'+lastRowIndex);
    $('#tbl1').last().append(ddl);

    //CKEDITOR.replace('tab_body['+lastRowIndex+']', {customConfig: '/adminlte/js/ckeditor.js'})
   cnt++;
   });


  $(".tbl_rem").click(function(){
    var rowCount=0;
    if($('#custom_table tr').length>2){
        var rowCount = 1;
    }

    if($('#custom_table tr').length >1){

    // var Id = $('#tbl1 tr:last-child').attr('value');
    var Id = $(this).parent().parent().find('.tab_id').val();
    var closest_tr = $(this).closest('tr');
    if(Id==0)
    {
      closest_tr.remove();
      return false;
    }
         swal({
               title: 'Really destroy link ?',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
              }).then(function () {
                back.spin()
           $.ajax({
               url:  '/admin/gallery/deleteTabSections',
               type: 'post',
               data: { id: Id },
              // dataType: 'json',

           }).done(function (message) { 
             back.unSpin()
              if(message.rowCount==0){
                  location.reload();
              }else{
                  closest_tr.remove();
              }

           })
           .fail(function (jqXHR, ajaxOptions, thrownError) {
               swal('No response from server');
           });
       })
     }       
   
     else{
      swal('One tab section should be present in the page');
     }
     });


  $(document).on('click','.popup_selector_tab_new',function(event){

            event.preventDefault()
            var updateID = $(this).attr('data-inputid_tab_new')
            var elfinderUrl = '/elfinder/popup/'
            var triggerUrl = elfinderUrl + updateID
            $.colorbox({
                href: triggerUrl,
                fastIframe: true,
                iframe: true,
                width: '70%',
                height: '70%'
            })
        })

  $(document).on('click','.tbl_rem1',function(event){
           event.preventDefault()
            // alert($('#custom_table tr').length);
            if($('#custom_table tr').length >1){
             $('#tbl1 tr:last-child').remove();
             }else{
             swal('One entry should be present in the page');
             }
        })


