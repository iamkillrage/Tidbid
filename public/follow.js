$(document).on('click', '.followUser', function() {
    var influencerId = $(this).attr('data-userId');
    var url = $(this).attr('data-url');
    if(influencerId !='' && url !=''){
        $.ajax({
              url:"",
              method:"GET",
              data:{influencerId:influencerId},
              dataType:'json',
              success:function(resp){
                   
              }
        })

    } else {
        toastr.error('All input field are required..');
    }


    // Now you can use influencerId variable to perform further actions
});