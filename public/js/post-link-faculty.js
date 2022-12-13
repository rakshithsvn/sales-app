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
               url:  "/admin/linkfaculties/subcontent",
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


