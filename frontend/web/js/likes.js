$(document).ready(function () {
    var like =  $('.like');
    $(like).click(function () {
        var params = {
            'id' : $(this).attr('data-id')
        };
        $.post('/post/default/like', params, data => {
          console.log(data);
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
