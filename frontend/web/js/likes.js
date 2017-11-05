$(document).ready(function () {
    var like =  $('i.like');
   $('a.button-like').click(function () {
       var params = {
           'id' : $(this).attr('data-id')
       };
      $.post('/post/default/like', params, data => {
          if (data.success) {
              $('.likes-count').text(data.count);
           like.removeClass('fa-heart-o');
           like.addClass('fa-heart');
              like.addClass('red-heart');
              $(this).hide();
              $('a.button-unlike').show();
          }
      });
       return false;
   });
    $('a.button-unlike').click(function () {
        var params = {
            'id' : $(this).attr('data-id')
        };
        $.post('/post/default/unlike', params, data => {
            if (data.success) {
                $('.likes-count').text(data.count);
                like.removeClass('red-heart');
                like.removeClass('fa-heart');
                like.addClass('fa-heart-o');
                $(this).hide();
                $('a.button-like').show();
            }
        });
        return false;
    })
});
