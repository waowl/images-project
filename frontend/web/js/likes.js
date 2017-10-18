$(document).ready(function () {
   $('a.button-like').click(function () {
       var params = {
           'id' : $(this).attr('data-id')
       };
      $.post('/post/default/like', params, data => {
          if (data.success) {
              $('.likes-count').text(data.count);
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
                $(this).hide();
                $('a.button-like').show();
            }
        });
        return false;
    })
});
