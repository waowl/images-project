$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
   $('a.button-complain').click(function () {
       var params = {
         'id' :  $(this).attr('data-id'),
           '_csrf-frontend' : csrfToken
       };
       $.post('/post/default/complain', params, function (data) {
           if(data.success){
               $('.bottom__complain').innerHTML = "<p>Post has been reported.</p>"
           }

       });
       return false;
   });
});