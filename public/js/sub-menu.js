$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('click','#submitPost',function(){
 
            var parent_menu_value = $("#parent_menu_id").val();
            if(parent_menu_value == 0)
            {
                swal('Please select the parent menu');
                 return false;
            }

            var child_menu = $("#child_menu").val();
            if(child_menu == "")
                {
                    swal('Please select the option from display child menu');
                     return false;
                }

           	var name = $("#name").val();
            if(name == "")
                {
                    swal('Please fill the sub menu name');
                     return false;
                }

            if($('#link_active').is(':checked')) {

            var link = $("#link").val();
            if(link == "")
                {
                    swal('Please fill the External link');
                    return false;
                }
            }

  });


$("#parent_menu_id").change(function (e) {

        e.preventDefault();
         var Id = $(this).val();

      if(Id!=''){
           $.ajax({
               url:  "/admin/submenu/hierarchy",
               type: "GET",
               data: { id: Id},
            dataType: 'json',
         }).done(function (message) {

                  $("#hierarchy").val(message);

           })
           .fail(function (jqXHR, ajaxOptions, thrownError) {
               swal('No response from server');
           });
       }

    });

if(route=='create')
{
	 $(document).on('click','#submitPost',function(){
	var result = false;
  	var hierarchy = $('#hierarchy').val();
   	var parent_menu_id = $('#parent_menu_id').val();
   	var child_menu = $('#child_menu').val();
   	var name = $('#name').val();

   if($('#link_active').is(':checked')) {
      var link = $('#link').val();
    }else{
      var link = 'null';
    }
           $.ajax({

              url:"/admin/submenu/checkhierarchy",
               type: 'POST',
                data: { hierarchy:hierarchy,parent_menu_id:parent_menu_id},
           }).done(function (message) {

           message = $.trim(message);
                 result = (message=='success') ? true : false;
     // alert(result);
                 if(!result)
                    {
                        swal("Error!", 'Hierarchy Already Exist, Please enter correct hierarchy',"error");
                        $('#hierarchy').val("");
                        $("#hierarchy").focus();
                      
                 }
                 else
                 {

                 	 
                 	 if( hierarchy!='' && parent_menu_id != '' && child_menu != '' && name!='' && link != ''){
                 	 	$('#submitCreate').submit();
                 	 }
                 	
                 }
          
            })


            return false;

 });

}
else
{

	$(document).on('click','#submitPost',function(){
	var result = false;
  	var hierarchy = $('#hierarchy').val();
   	var parent_menu_id = $('#parent_menu_id').val();
   	var id = menu_id;
   	var child_menu = $('#child_menu').val();
   	var name = $('#name').val();

    if($('#link_active').is(':checked')) {
      var link = $('#link').val();
    }else{
      var link = 'null';
    }

           $.ajax({

              url:"/admin/submenu/checkPosthierarchy",
               type: 'POST',
                data: { hierarchy:hierarchy,parent_menu_id:parent_menu_id,id:id},
           }).done(function (message) {

           message = $.trim(message);
                 result = (message=='success') ? true : false;
     // alert(result);
                 if(!result)
                    {
                      swal("Error!", 'Hierarchy Already Exist, Please enter correct hierarchy',"error");
                      $('#hierarchy').val("");
                      $("#hierarchy").focus();
                       
                 }
                 else
                 {
                 	 if( hierarchy!='' && parent_menu_id != '' && child_menu != '' && name!='' && link!=''){
                 	 	$('#submitUpdate').submit();
                 	 }
                 }
          
            })
           return false;

 });

}

