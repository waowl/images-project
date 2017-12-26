$(document).ready(function () {
   $('a.button-complain').click(function () {
       var button  = $(this);
       var params = {
         'id' :  $(this).attr('data-id'),
       };
       $.post('/post/default/complain', params, function (data) {
           if(data.success){
               button.parent().html("<p>Post has been reported</p>");
           }
       });
       return false;
   });
});