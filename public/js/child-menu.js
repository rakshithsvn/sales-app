$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).on('click','#submitPost',function(){
 
            var sub_menu_value = $("#sub_menu_id").val();
            if(sub_menu_value == 0)
            {
                swal('Please select the sub menu');
                 return false;
            }

           	var name = $("#name").val();
            if(name == "")
                {
                    swal('Please fill the child menu name');
                     return false;
                }


  });


$("#sub_menu_id").change(function (e) {

        e.preventDefault();
         var Id = $(this).val();

      if(Id!=''){
           $.ajax({
               url:  "/admin/childmenu/hierarchy",
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
   	var sub_menu_id = $('#sub_menu_id').val();
   	var name = $('#name').val();
  

           $.ajax({

              url:"/admin/childmenu/checkhierarchy",
               type: 'POST',
                data: { hierarchy:hierarchy,sub_menu_id:sub_menu_id},
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

                 	 
                 	 if( hierarchy!='' && sub_menu_id != '' && name!=''){
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
   	var sub_menu_id = $('#sub_menu_id').val();
   	var id = menu_id;
   	var name = $('#name').val();


           $.ajax({

              url:"/admin/childmenu/checkPosthierarchy",
               type: 'POST',
                data: { hierarchy:hierarchy,sub_menu_id:sub_menu_id,id:id},
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
                 	 if( hierarchy!='' && sub_menu_id != '' && name!=''){
                 	 	$('#submitUpdate').submit();
                 	 }
                 }
          
            })
           return false;

 });

}

